<?php
/**
 * WARNING: Do not edit by hand, this file was generated by Crank:
 *
 * https://github.com/gocardless/crank
 */

namespace GoCardlessPro\Resources;

/**
 * A thin wrapper around a institution, providing access to its
 * attributes
 *
 * @property-read $country_code
 * @property-read $icon_url
 * @property-read $id
 * @property-read $logo_url
 * @property-read $name
 */
class Institution extends BaseResource
{
    protected $model_name = "Institution";

    /**
     * [ISO
     * 3166-1](http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2#Officially_assigned_code_elements)
     * alpha-2 code. The country code of the institution.
     */
    protected $country_code;

    /**
     * A URL pointing to the icon for this institution
     */
    protected $icon_url;

    /**
     * The unique identifier for this institution
     */
    protected $id;

    /**
     * A URL pointing to the logo for this institution
     */
    protected $logo_url;

    /**
     * A human readable name for this institution
     */
    protected $name;

}