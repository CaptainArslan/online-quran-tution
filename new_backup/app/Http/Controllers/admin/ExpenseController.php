<?php

namespace App\Http\Controllers\admin;

use App\Models\Expense;
use App\Exports\Expenses;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function list(Request $req)
    {
        $expense = Expense::orderBy('id', 'DESC');
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $totalWeeklyExpenses = Expense::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $totalMonthlyExpenses = Expense::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('amount');

        $totalExpenses = $expense->sum('amount');


        if ($req->filter_type) {
            if ($req->filter_type == 'daily') {
                $expense->whereDate('created_at', Carbon::today()->format('Y-m-d'));
            }
            if ($req->filter_type == 'weekly') {
                $expense->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            }
            if ($req->filter_type == 'monthly') {
                $expense->whereMonth('created_at', Carbon::today()->month);
            }
        }

        if (isset($req->from) && isset($req->to)) {
            $expense = $expense->whereBetween('date', [$req->from, $req->to]);
        } elseif (isset($req->from) && !isset($req->to)) {
            $expense = $expense->where('date', '>', $req->from);
        } elseif (!isset($req->from) && isset($req->to)) {
            $expense = $expense->where('date', '<', $req->to);
        }

        $expense = $expense->get();

        if ($req->export) {
            return Excel::download(new Expenses($expense), 'expenses.xlsx');
        }

        return view('admin.expense.list', get_defined_vars());
    }

    public function add()
    {
        return view('admin.expense.add', get_defined_vars());
    }

    public function edit($id = null)
    {
        $expense = Expense::find($id);

        return view('admin.expense.edit', get_defined_vars());
    }

    public function save(Request $req, $id = null)
    {
        $req->validate([
            'amount' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);

        if ($req->has('receipt')) {
            $receipt = uploadAvatar($req->receipt, 'uploads/expenses');
        } else {
            if ($id != null) {
                $exp = Expense::find($id);
                $receipt = $exp->receipt;
            } else {
                $receipt = null;
            }
        }

        if (is_null($id)) {
            Expense::create([
                'amount' => $req->amount,
                'description' => $req->description,
                'date' => $req->date,
                'receipt' => $receipt,
            ]);
        } else {
            Expense::find($id)->update([
                'amount' => $req->amount,
                'description' => $req->description,
                'date' => $req->date,
                'receipt' => $receipt,
            ]);
        }

        return redirect()->route('admin.expense.list')->with('message', 'Expense Updated Successfully');
    }

    public function delete($id = null)
    {
        Expense::find($id)->delete();

        return redirect()->route('admin.expense.list')->with('message', 'Expense Deleted Successfully');
    }
}
