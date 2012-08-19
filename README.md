# ci-dynamic-config

# CodeIgniter Dynamic System Configuration

## Description

This will enable you to have system options (like the WordPress CMS) that you can save, retrieve, and change on the fly.

The options are saved in a database table (structure included in the .sql file)

## Setup

Put the system_options_model.php file into your models folder.

Add the `system_options` table to your database by running the sql file included in the root directory.

It's important to have the index created in your table! Check to make sure it's made, or your options might get duplicated.

## Usage

Use

    $this->load->model("system_options_model", "system_options");

In your controller to load the system options model for use.

It provides you with 2 functions.

### get_option( var $name, var $if_none );

Use the get_option method to retrieve your options. It takes 2 arguments.

Setting the name argument tells the method which option to look up.

Setting the if_none argument tells the method what to return if nothing is set already in the system_options table. A default value, so to speak.

#### Example:

    $site_description = $this->system_options->get_option( "site_description", "A Useful Site!" );

Running this would return the site description if it was set in the database. If there was nothing set already, it would return "A Useful Site!"

### update_option( var $name, var $value );

Use the update_option method to set your options. It takes 2 arguments.

Setting the name argument tells the method what option to set.

Setting the value argument tells the method what to set that option you specified by the name argument.

#### Example:

    $this->system_options->update_option( "site_description", "A Useful Site!" );

Running this would set the site_description option in the database to "A Useful Site!" for later retrieval.

## Thanks!

I hope someone besides me finds this useful! Also, by all means please let me know if there's other functionality that would be useful!