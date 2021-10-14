<?php // Removing DearPDF Hooks

function remove_action_dp(){
    // Single Page
    remove_all_actions('dearpdf_single_content');
    add_action('dearpdf_single_content','pn_single_template_content');
    // Category
    remove_all_actions('dearpdf_category_content');
    add_action('dearpdf_category_content','pn_category_single_template_content');
}

add_action('after_dearpdf_init_templates','remove_action_dp');
