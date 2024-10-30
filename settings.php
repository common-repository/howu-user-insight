<?php
add_action('admin_menu', 'howuku_add_admin_menu');
add_action('admin_init', 'howuku_settings_init');

function howuku_add_admin_menu () {
  add_options_page('Howuku', 'Howuku', 'manage_options', 'howuku', 'howuku_options_page');
}

function howuku_settings_init () {
	register_setting(
    'howuku',
    'howuku_key',
    [
      'type' => 'string',
      'sanitize_callback' => 'sanitize_text_field'
    ]
  );

	add_settings_section(
		'howuku_config_section',
    '',
		'howuku_settings_section_callback',
		'howuku'
	);

	add_settings_field(
		'howuku_key',
		__( 'Widget Key', 'howuku' ),
		'howuku_key_render',
		'howuku',
    'howuku_config_section'
	);
}


function howuku_key_render () {
  $value = get_option('howuku_key');  
?>
	<input
    type="text"
    autocomplete="off"
    autocorrect="off"
    autocapitalize="off"
    spellcheck="false"
    name="howuku_key"
    style="min-width: 250px"
    class="code"
    value="<?php echo $value; ?>"
  />
  <br />
  <span class="description">
    You can find Widget Key in Embed section of <a target="_blank" href="https://app.howuku.com/#/app">Application Page</a>
  </span>
<?php
}

function howuku_settings_section_callback () {
?>
  <h4>
    Enter your Howuku Widget Key below to show your widget on your site.<br />
  </h4>
  <h4>To view reports, go to <a target="_blank" href="https://app.howuku.com/">Howuku Dashboard</a>.</h4>
<?php
}

function howuku_options_page () {
  wp_register_style( 'howukuStyle', false );
  wp_enqueue_style( 'howukuStyle' );
  wp_add_inline_style( 'howukuStyle', '.howuku-settings h1 {margin-bottom: .5rem;}.howuku-settings .form-table th {width: 100px;}' );    
?>
  <div class="howuku-settings wrap">

    <form action="options.php" method="post">

      <h1>Howuku User Insight</h1>

      <h2>Setup</h2>

      <?php
      settings_fields('howuku');
      do_settings_sections('howuku');
      submit_button();
      ?>

    </form>

  </div>
<?php
}
?>