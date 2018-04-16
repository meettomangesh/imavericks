<?php
defined('ABSPATH') or die("No script kiddies please!");
global $post;
$post_id = $post->ID;
$smls_option = get_post_meta($post_id, 'smls_option', true);
//$this->print_array($smls_option);
?>
<div class="smls-logo-backend-wrapper">
    <div class="smls-add-single-logo-wrap">
        <input type="button" class="button-primary smls-add-logo-button" value="<?php _e('Add Logo', SMLS_TD); ?>">
        <div class="smls-add-append-wrap clearfix">
            <?php
            if (isset($smls_option['logo']) && is_array($smls_option['logo'])) {
                $smls_logo_count = count($smls_option['logo']);
            } else {
                $smls_logo_count = 0;
            }
            if ($smls_logo_count > 0) {

                foreach ($smls_option['logo'] as $logo_key => $logo_detail) {
                    include(SMLS_PATH . 'inc/admin/smls-forms/smls-form-detail.php');
                }
            }
            ?>
        </div>
    </div>
</div>

