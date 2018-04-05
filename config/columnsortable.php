<?php

return [

    /*
    spec columns
    */
    'columns'                       => [
        'alpha'   => [
            'rows'  => ['email', 'slug'],
            'class' => 'fas fa-sort-alpha',
        ],
        'amount'  => [
            'rows'  => ['amount', 'price'],
            'class' => 'fas fa-sort-amount',
        ],
        'numeric' => [
            'rows'  => ['created_at', 'updated_at', 'level', 'id', 'phone_number'],
            'class' => 'fas fa-sort-numeric',
        ],
    ],

    /*
    whether icons should be enabled
     */
    'enable_icons'                  => true,

    /*
    defines icon set to use when sorted data is none above (alpha nor amount nor numeric)
     */
    'default_icon_set'              => 'fas fa-sort',

    /*
    icon that shows when generating sortable link while column is not sorted
     */
    'sortable_icon'                 => 'fas fa-sort',

    /*
    generated icon is clickable non-clickable (default)
     */
    'clickable_icon'                => true,

    /*
    icon and text separator (any string)
    in case of 'clickable_icon' => true; separator creates possibility to style icon and anchor-text properly
     */
    'icon_text_separator'           => ' ',

    /*
    suffix class that is appended when ascending order is applied
     */
    'asc_suffix'                    => '-down',

    /*
    suffix class that is appended when descending order is applied
     */
    'desc_suffix'                   => '-up',

    /*
    default anchor class, if value is null none is added
     */
    'anchor_class'                  => null,

    /*
    default active anchor class, if value is null none is added
     */
    'active_anchor_class'           => null,

    /*
    default sort order anchor class, if value is null none is added
     */
    'order_anchor_class_prefix'     => null,

    /*
    relation - column separator ex: detail.phone_number means relation "detail" and column "phone_number"
     */
    'uri_relation_column_separator' => '.',

    /*
    formatting function applied to name of column, use null to turn formatting off
     */
    'formatting_function'           => 'ucfirst',

    /*
    inject title parameter in query strings, use null to turn injection off
    example: 'inject_title' => 't' will result in ..user/?t="formatted title of sorted column"
     */
    'inject_title_as'               => null,

    /*
    allow request modification, when default sorting is set but is not in URI (first load)
     */
    'allow_request_modification'    => true,

    /*
    default order for: $user->sortable('id') usage
     */
    'default_direction'             => 'asc',

    /*
    default order for non-sorted columns
     */
    'default_direction_unsorted'    => 'asc',

    /*
    join type: join vs leftJoin (default leftJoin)
    for more information see https://github.com/Kyslik/column-sortable/issues/59
    */
    'join_type'                          => 'leftJoin',
];
