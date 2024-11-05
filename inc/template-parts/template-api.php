<?php
// Get WooCommerce API credentials from the WordPress options
$client_id        = get_option( 'be-client-id' ) ?? '';
$client_secret    = get_option( 'be-client-secret' ) ?? '';
$jap_api_base_url = get_option( 'jap_api_base_url' ) ?? '';
$jap_api_key      = get_option( 'jap_api_key' ) ?? '';
?>

<!-- API credentials form -->
<div class="container-fluid api-credentials">
    <div class="row">
        <div class="col-md-12">
            <!-- Title for the API credentials section -->
            <h4 class="text-center mb-4">
                <?php esc_html_e( 'WooCommerce API Credentials', 'just-another-panel' ); ?>
            </h4>

            <!-- Form for entering WooCommerce API credentials -->
            <form id="client-credentials-form">
                <div class="row mb-3">
                    <!-- Label for Client ID -->
                    <label class="col-sm-4 col-form-label text-start" for="client-id">
                        <?php esc_html_e( 'Consumer Key', 'just-another-panel' ); ?>
                    </label>
                    <!-- Input for Consumer Key -->
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="client-id" id="client-id"
                            value="<?php echo esc_attr( $client_id ); ?>"
                            placeholder="<?php esc_attr_e( 'Consumer Key', 'just-another-panel' ); ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Label for Client Secret -->
                    <label class="col-sm-4 col-form-label text-start" for="client-secret">
                        <?php esc_html_e( 'Consumer Secret', 'just-another-panel' ); ?>
                    </label>
                    <!-- Input for Consumer Secret -->
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="client-secret" id="client-secret"
                            value="<?php echo esc_attr( $client_secret ); ?>"
                            placeholder="<?php esc_attr_e( 'Consumer Secret', 'just-another-panel' ); ?>" required>
                    </div>
                </div>

                <!-- Title for the JAP API credentials section -->
                <h4 class="text-center mb-4 mt-5">
                    <?php esc_html_e( 'JustAnotherPanel API Credentials', 'just-another-panel' ); ?>
                </h4>

                <div class="row mb-3">
                    <!-- Label for Client Secret -->
                    <label class="col-sm-4 col-form-label text-start" for="jap_api_base_url">
                        <?php esc_html_e( 'API Url', 'just-another-panel' ); ?>
                    </label>
                    <!-- Input for Client Secret -->
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="jap_api_base_url" id="jap_api_base_url"
                            value="<?php echo esc_attr( $jap_api_base_url ); ?>"
                            placeholder="<?php esc_attr_e( 'API Url', 'just-another-panel' ); ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- Label for Client Secret -->
                    <label class="col-sm-4 col-form-label text-start" for="jap_api_key">
                        <?php esc_html_e( 'API Key', 'just-another-panel' ); ?>
                    </label>
                    <!-- Input for Client Secret -->
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="jap_api_key" id="jap_api_key"
                            value="<?php echo esc_attr( $jap_api_key ); ?>"
                            placeholder="<?php esc_attr_e( 'API Key', 'just-another-panel' ); ?>" required>
                    </div>
                </div>

                <!-- Submit button to save credentials -->
                <div class="row mt-4">
                    <div class="col text-start">
                        <input type="submit" class="btn btn-primary" id="credential-save"
                            value="<?php esc_attr_e( 'Save', 'just-another-panel' ); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>