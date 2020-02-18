<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	die;
}

/** How to use

vc_add_param( $shortcode, array(
	'type' => 'bb_responsive',
	'heading' => 'label',
	'param_name' => 'responsive',
	'group' => $group,
)); */

if (!class_exists('BestBug_Extend_VcParams_Responsive')) {
	class BestBug_Extend_VcParams_Responsive
	{
		public $post_css;

		function __construct()
		{
			add_action('init', array($this, 'init'));
		}

		function init()
		{
			if (class_exists('WpbakeryShortcodeParams')) {
				WpbakeryShortcodeParams::addField('bb_responsive', array($this, 'bb_responsive'), WPE_CORE_URL . '/assets/admin/js/extend/vc-params/responsive.js?nocache=true');
				
				// Load enqueueScripts
				if (is_admin()) {
					add_action('admin_enqueue_scripts', array($this, 'adminEnqueueScripts'));
				}
				add_action('admin_footer', array($this, 'template'));

			}
			add_action('save_post', array(&$this, 'save_post'), 11);
		}

		function bb_responsive($settings, $value)
		{

			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$use = isset($settings['use']) ? implode(',', $settings['use']) : '';
			$selector = isset($settings['selector']) && empty($value) ? $settings['selector'] : '';

			$output = '<div class="bb-responsive-field" data-name="' . $param_name . '" data-value="' . $value . '" data-use="' . $use . '" data-selector="' . $selector . '"></div>';

			return $output;
		}

		public function adminEnqueueScripts()
		{
			// Add the color picker css file
			wp_enqueue_style('wp-color-picker');

			wp_enqueue_style('bb-responsive', WPE_CORE_URL . '/assets/admin/css/extend/vc-params/responsive.css');
		}

		public function template_css_box()
		{
			?>
			<div class="bb-responsive-css_box bb-responsive-container vc_css-editor vc_row" data-template="css_box">
				<div class="vc_layout-onion vc_col-xs-7">
					<div class="vc_margin">
						<label>margin</label>
						<input type="text" name="marginTop" class="vc_top bb-binddata" placeholder="-" value="{{marginTop}}">
						<input type="text" name="marginRight" class="vc_right bb-binddata" placeholder="-" value="{{marginRight}}">
						<input type="text" name="marginBottom" class="vc_bottom bb-binddata" placeholder="-" value="{{marginBottom}}">
						<input type="text" name="marginLeft" class="vc_left bb-binddata" placeholder="-" value="{{marginLeft}}">
						
						<div class="vc_border">
							<label>border</label>
							<input type="text" name="borderTopWidth" class="vc_top bb-binddata" placeholder="-" value="{{borderTopWidth}}">
							<input type="text" name="borderRightWidth" class="vc_right bb-binddata" placeholder="-" value="{{borderRightWidth}}">
							<input type="text" name="borderBottomWidth" class="vc_bottom bb-binddata" placeholder="-" value="{{borderBottomWidth}}">
							<input type="text" name="borderLeftWidth" class="vc_left bb-binddata" placeholder="-" value="{{borderLeftWidth}}">
							<div class="vc_padding">
								<label>padding</label>
								<input type="text" name="paddingTop" class="vc_top bb-binddata" placeholder="-" value="{{paddingTop}}">
								<input type="text" name="paddingRight" class="vc_right bb-binddata" placeholder="-" value="{{paddingRight}}">
								<input type="text" name="paddingBottom" class="vc_bottom bb-binddata" placeholder="-" value="{{paddingBottom}}">
								<input type="text" name="paddingLeft" class="vc_left bb-binddata" placeholder="-" value="{{paddingLeft}}">
								<div class="vc_content"><i></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="vc_col-xs-5 vc_settings"> 
					<label>Border color</label>
					<div class="color-group">
						<input name="borderColor" type="text" class="bb-color-picker bb-binddata" value="{{borderColor}}" />    
					</div>
					<label>Border style</label>
					<div class="vc_border-style">
						<select name="borderStyle" type="text" class="bb-binddata vc_border-style" data-value="{{borderStyle}}">
							<option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
							<option value="dotted"><?php esc_html_e('Dotted', 'wpelite'); ?></option>
							<option value="dashed"><?php esc_html_e('Dashed', 'wpelite'); ?></option>
							<option value="solid"><?php esc_html_e('Solid', 'wpelite'); ?></option>
							<option value="double"><?php esc_html_e('Double', 'wpelite'); ?></option>
							<option value="groove"><?php esc_html_e('Groove', 'wpelite'); ?></option>
							<option value="ridge"><?php esc_html_e('Ridge', 'wpelite'); ?></option>
							<option value="none"><?php esc_html_e('None', 'wpelite'); ?></option>
							<option value="hidden"><?php esc_html_e('Hidden', 'wpelite'); ?></option>
							<option value="inset"><?php esc_html_e('Inset', 'wpelite'); ?></option>
							<option value="outset"><?php esc_html_e('Outset', 'wpelite'); ?></option>
							<option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
							<option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
					  </select> 
					</div> 
					<label>Border radius</label>
					<div class="vc_border-radius">
						<div class="bb-responsive-section">
							<span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('TopLeft', 'wpelite'); ?>">
								<span class="wphb-cst-rotate01 dashicons dashicons-arrow-up-alt2"></span>
							</span>
							<input name="borderTopLeftRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderTopLeftRadius}}" placeholder="" />    
						</div>
						<div class="vc_cleafix"></div>
						<br/>
						<div class="bb-responsive-section">
							<span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('TopRight', 'wpelite'); ?>">
								<span class="wphb-cst-rotate02 dashicons dashicons-arrow-up-alt2"></span>
							</span>
							<input name="borderTopRightRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderTopRightRadius}}" placeholder="" />    
						</div>
						<div class="vc_cleafix"></div>
						<br/>
						<div class="bb-responsive-section">
							<span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('BottomRight', 'wpelite'); ?>">
								<span class="wphb-cst-rotate03 dashicons dashicons-arrow-up-alt2"></span>
							</span>
							<input name="borderBottomRightRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderBottomRightRadius}}" placeholder="" />    
						</div>
						<div class="vc_cleafix"></div>
						<br/>
						<div class="bb-responsive-section">
							<span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('BottomLeft', 'wpelite'); ?>">
								<span class="wphb-cst-rotate04 dashicons dashicons-arrow-up-alt2"></span>
							</span>
							<input name="borderBottomLeftRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderBottomLeftRadius}}" placeholder="" />    
						</div>
					</div> 
				</div>
			</div>
			<?php

	}

	public function template_font()
	{
		?>
			<div class="bb-responsive-font bb-responsive-container" data-template="font">
			   <div class="child-label"><?php esc_html_e('Text', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Text Color', 'wpelite'); ?>">
						  <span class="dashicons dashicons-editor-help"></span> 
						  <?php esc_html_e('Text color', 'wpelite'); ?>
					   </span>
					   <input name="color" type="text" class="bb-tiny-input bb-color-picker bb-binddata" value="{{color}}" />    
					</div>
		   		</div>
				<div class="bb-responsive-group-container">
 				   <div class="bb-responsive-section">
 					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Font family', 'wpelite'); ?>">
 						 <span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('Font family', 'wpelite'); ?>
 					  </span>
 					  <input name="fontFamily" type="text" class="bb-tiny-input bb-normal-input bb-binddata" value="{{fontFamily}}" />    
 				   </div>
 		   		</div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Font size', 'wpelite'); ?>">
						 <span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('Font size', 'wpelite'); ?>
					  </span>
					  <input name="fontSize" type="text" class="bb-tiny-input bb-binddata" value="{{fontSize}}" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Line height', 'wpelite'); ?>">
						 <span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('Line height', 'wpelite'); ?>
					  </span>
					  <input name="lineHeight" type="text" class="bb-tiny-input bb-binddata" value="{{lineHeight}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Letter spacing', 'wpelite'); ?>">
						 <span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('Letter spacing', 'wpelite'); ?>
					  </span>
					  <input name="letterSpacing" type="text" class="bb-tiny-input bb-binddata" value="{{letterSpacing}}" placeholder="" />    
				   </div>
		   		</div>
				
				<div class="bb-responsive-group-container">
 				   <div class="bb-responsive-section">
 					   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Text align', 'wpelite'); ?>">
 						  <span class="dashicons dashicons-editor-help"></span> 
 						  <?php esc_html_e('Text align', 'wpelite'); ?>
 					   </span>
					   <span class="bb-list-radio" data-radio="{{textAlign}}">
						   
						   <span class="bbradio-responsive">
    						   <input id="textAlignDefault{{name}}" name="textAlign{{name}}" data-name="textAlign" type="radio" class="bb-tiny-input bb-binddata" value="" /> 
    						   <label for="textAlignDefault{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Default', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-no-alt"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textAlignLeft{{name}}" name="textAlign{{name}}" data-name="textAlign" type="radio" class="bb-tiny-input bb-binddata" value="left" /> 
    						   <label for="textAlignLeft{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Left', 'wpelite'); ?>">
								   <span class="dashicons dashicons-editor-alignleft"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textAlignCenter{{name}}" name="textAlign{{name}}" data-name="textAlign" type="radio" class="bb-tiny-input bb-binddata" value="center" /> 
    						   <label for="textAlignCenter{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Center', 'wpelite'); ?>">
								   <span class="dashicons dashicons-editor-aligncenter"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textAlignRight{{name}}" name="textAlign{{name}}" data-name="textAlign" type="radio" class="bb-tiny-input bb-binddata" value="right" /> 
    						   <label for="textAlignRight{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Right', 'wpelite'); ?>">
								   <span class="dashicons dashicons-editor-alignright"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textAlignJustify{{name}}" name="textAlign{{name}}" data-name="textAlign" type="radio" class="bb-tiny-input bb-binddata" value="justify" /> 
    						   <label for="textAlignJustify{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Justify', 'wpelite'); ?>">
								   <span class="dashicons dashicons-editor-justify"></span>
    						   </label>
						   </span>
					   </span> 
 					</div>
 		   		</div>
				
				<div class="bb-responsive-group-container">
 				   <div class="bb-responsive-section">
 					   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Font weight', 'wpelite'); ?>">
 						  <span class="dashicons dashicons-editor-help"></span> 
 						  <?php esc_html_e('Font weight', 'wpelite'); ?>
 					   </span>
					   <span class="bb-list-radio" data-radio="{{fontWeight}}">
						   <span class="bbradio-responsive">
    						   <input id="fontWeightDefault{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="" /> 
    						   <label for="fontWeightDefault{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Default', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-no-alt"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="fontWeight100{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="100" /> 
    						   <label for="fontWeight100{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Thin - Hairline (100)', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-editor-textcolor bb-fontweight-100"></span>
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="fontWeight200{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="200" /> 
    						   <label for="fontWeight200{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Extra Light - Ultra Light (200)', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-editor-textcolor bb-fontweight-200"></span>
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="fontWeight300{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="300" /> 
    						   <label for="fontWeight300{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Light (300)', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-editor-textcolor bb-fontweight-300"></span>
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="fontWeight400{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="400" /> 
    						   <label for="fontWeight400{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Normal (400)', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-editor-textcolor bb-fontweight-400"></span>
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="fontWeight500{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="500" /> 
    						   <label for="fontWeight500{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Medium (500)', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-editor-textcolor bb-fontweight-500"></span>
    						   </label>
						   </span>
						  <span class="bbradio-responsive">
							  <input id="fontWeight600{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="600" /> 
							  <label for="fontWeight600{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Semi Bold - Demi Bold (600)', 'wpelite'); ?>">
								 <span class="dashicons dashicons-editor-textcolor bb-fontweight-600"></span>
							  </label>
						  </span>
						  <span class="bbradio-responsive">
							  <input id="fontWeight700{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="700" /> 
							  <label for="fontWeight700{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Bold (700)', 'wpelite'); ?>">
								 <span class="dashicons dashicons-editor-textcolor bb-fontweight-700"></span>
							  </label>
						  </span>
						  <span class="bbradio-responsive">
							  <input id="fontWeight800{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="800" /> 
							  <label for="fontWeight800{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Extra Bold - Ultra Bold (800)', 'wpelite'); ?>">
								 <span class="dashicons dashicons-editor-textcolor bb-fontweight-800"></span>
							  </label>
						  </span>
						  <span class="bbradio-responsive">
							  <input id="fontWeight900{{name}}" name="fontWeight{{name}}" data-name="fontWeight" type="radio" class="bb-tiny-input bb-binddata" value="900" /> 
							  <label for="fontWeight900{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Black - Heavy (900)', 'wpelite'); ?>">
								 <span class="dashicons dashicons-editor-textcolor bb-fontweight-900"></span>
							  </label>
						  </span>
					   </span> 
 					</div>
 		   		</div>
				
				<div class="bb-responsive-group-container">
 				   <div class="bb-responsive-section">
 					   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Font style', 'wpelite'); ?>">
 						  <span class="dashicons dashicons-editor-help"></span> 
 						  <?php esc_html_e('Font style', 'wpelite'); ?>
 					   </span>
					   <span class="bb-list-radio" data-radio="{{fontStyle}}">
						   
						   <span class="bbradio-responsive">
    						   <input id="fontStyleDefault{{name}}" name="fontStyle{{name}}" data-name="fontStyle" type="radio" class="bb-tiny-input bb-binddata" value="" /> 
    						   <label for="fontStyleDefault{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Default', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-no-alt"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="fontStyleNormal{{name}}" name="fontStyle{{name}}" data-name="fontStyle" type="radio" class="bb-tiny-input bb-binddata" value="normal" /> 
    						   <label for="fontStyleNormal{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Normal', 'wpelite'); ?>">
								   <span class="dashicons dashicons-editor-textcolor"></span>
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="fontStyleItalic{{name}}" name="fontStyle{{name}}" data-name="fontStyle" type="radio" class="bb-tiny-input bb-binddata" value="italic" /> 
    						   <label for="fontStyleItalic{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Italic', 'wpelite'); ?>">
								   <span class="dashicons dashicons-editor-italic"></span>
    						   </label>
						   </span>
					   </span> 
 					</div>
 		   		</div>
				
				<div class="bb-responsive-group-container">
 				   <div class="bb-responsive-section">
 					   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Text transform', 'wpelite'); ?>">
 						  <span class="dashicons dashicons-editor-help"></span> 
 						  <?php esc_html_e('Text transform', 'wpelite'); ?>
 					   </span>
					   <span class="bb-list-radio" data-radio="{{textTransform}}">
						   
						   <span class="bbradio-responsive">
    						   <input id="textTransformDefault{{name}}" name="textTransform{{name}}" data-name="textTransform" type="radio" class="bb-tiny-input bb-binddata" value="" /> 
    						   <label for="textTransformDefault{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Default', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-no-alt"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textTransformNone{{name}}" name="textTransform{{name}}" data-name="textTransform" type="radio" class="bb-tiny-input bb-binddata" value="none" /> 
    						   <label for="textTransformNone{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('None', 'wpelite'); ?>">
    							  <span>Aa</span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textTransformUppercase{{name}}" name="textTransform{{name}}" data-name="textTransform" type="radio" class="bb-tiny-input bb-binddata" value="uppercase" /> 
    						   <label for="textTransformUppercase{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Uppercase', 'wpelite'); ?>">
    							  <span>AA</span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textTransformLowercase{{name}}" name="textTransform{{name}}" data-name="textTransform" type="radio" class="bb-tiny-input bb-binddata" value="lowercase" /> 
    						   <label for="textTransformLowercase{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Lowercase', 'wpelite'); ?>">
    							  <span>aa</span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textTransformCapitalize{{name}}" name="textTransform{{name}}" data-name="textTransform" type="radio" class="bb-tiny-input bb-binddata" value="capitalize" /> 
    						   <label for="textTransformCapitalize{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Capitalize', 'wpelite'); ?>">
    							  <span>Aa</span>
    						   </label>
						   </span>
					   </span> 
 					</div>
 		   		</div>
				
				<div class="bb-responsive-group-container">
 				   <div class="bb-responsive-section">
 					   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Text decoration', 'wpelite'); ?>">
 						  <span class="dashicons dashicons-editor-help"></span> 
 						  <?php esc_html_e('Text decoration', 'wpelite'); ?>
 					   </span>
					   <span class="bb-list-radio" data-radio="{{textDecoration}}">
						   
						   <span class="bbradio-responsive">
    						   <input id="textDecorationDefault{{name}}" name="textDecoration{{name}}" data-name="textDecoration" type="radio" class="bb-tiny-input bb-binddata" value="" /> 
    						   <label for="textDecorationDefault{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Default', 'wpelite'); ?>">
    							  <span class="dashicons dashicons-no-alt"></span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textDecorationNone{{name}}" name="textDecoration{{name}}" data-name="textDecoration" type="radio" class="bb-tiny-input bb-binddata" value="none" /> 
    						   <label for="textDecorationNone{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('None', 'wpelite'); ?>">
    							  <span class="bb-text-decoration-none">abc</span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textDecorationOverline{{name}}" name="textDecoration{{name}}" data-name="textDecoration" type="radio" class="bb-tiny-input bb-binddata" value="overline" /> 
    						   <label for="textDecorationOverline{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Overline', 'wpelite'); ?>">
    							  <span class="bb-text-decoration-overline">abc</span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textDecorationUnderline{{name}}" name="textDecoration{{name}}" data-name="textDecoration" type="radio" class="bb-tiny-input bb-binddata" value="underline" /> 
    						   <label for="textDecorationUnderline{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Underline', 'wpelite'); ?>">
    							  <span class="bb-text-decoration-underline">abc</span> 
    						   </label>
						   </span>
						   <span class="bbradio-responsive">
    						   <input id="textDecorationLineThrough{{name}}" name="textDecoration{{name}}" data-name="textDecoration" type="radio" class="bb-tiny-input bb-binddata" value="line-through" /> 
    						   <label for="textDecorationLineThrough{{name}}" class="bbhelp--top" bbhelp-label="<?php esc_html_e('Line through', 'wpelite'); ?>">
    							  <span class="bb-text-decoration-line-through">abc</span> 
    						   </label>
						   </span>
					   </span> 
 					</div>
 		   		</div>
				
				<div class="bb-responsive-group-container">
					
 				   <div class="bb-responsive-section">
 					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Word spacing', 'wpelite'); ?>">
 						 <span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('Word spacing', 'wpelite'); ?>
 					  </span>
 					  <input name="wordSpacing" type="text" class="bb-tiny-input bb-binddata" value="{{wordSpacing}}" placeholder="" />    
 				   </div>
 				   <div class="bb-responsive-section">
 					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('White space', 'wpelite'); ?>">
 						 <span class="dashicons dashicons-editor-help"></span> 
						 <?php esc_html_e('White space', 'wpelite'); ?>
 					  </span>
					  <select name="whiteSpace" type="text" class="bb-tiny-input bb-binddata" data-value="{{whiteSpace}}">
						  <option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
						  <option value="normal"><?php esc_html_e('Normal', 'wpelite'); ?></option>
						  <option value="nowrap"><?php esc_html_e('Nowrap', 'wpelite'); ?></option>
						  <option value="pre"><?php esc_html_e('Pre', 'wpelite'); ?></option>
						  <option value="pre-line"><?php esc_html_e('Pre-line', 'wpelite'); ?></option>
						  <option value="pre-wrap"><?php esc_html_e('Pre-wrap', 'wpelite'); ?></option>
						  <option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
						  <option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
					  </select>
 				   </div>
 				   <div class="bb-responsive-section">
 					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Text overflow', 'wpelite'); ?>">
 						 <span class="dashicons dashicons-editor-help"></span> 
						 <?php esc_html_e('Text overflow', 'wpelite'); ?>
 					  </span> 
					  <select name="textOverflow" type="text" class="bb-tiny-input bb-binddata" data-value="{{textOverflow}}">
						  <option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
						  <option value="clip"><?php esc_html_e('Clip', 'wpelite'); ?></option>
						  <option value="ellipsis"><?php esc_html_e('Ellipsis', 'wpelite'); ?></option>
						  <option value="string"><?php esc_html_e('String', 'wpelite'); ?></option>
						  <option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
						  <option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
					  </select> 
 				   </div>
 		   		</div>
		   </div>
			<?php
		}

		public function template_padding()
		{
		?>
			<div class="bb-responsive-padding bb-responsive-container" data-template="padding">
			   <div class="child-label"><?php esc_html_e('Padding', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Top', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-up-alt"></span> 
					  </span>
					  <input name="paddingTop" type="text" class="bb-tiny-input bb-binddata" value="{{paddingTop}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Right', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-right-alt"></span> 
					  </span>
					  <input name="paddingRight" type="text" class="bb-tiny-input bb-binddata" value="{{paddingRight}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Bottom', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-down-alt"></span> 
					  </span>
					  <input name="paddingBottom" type="text" class="bb-tiny-input bb-binddata" value="{{paddingBottom}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Left', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-left-alt"></span> 
					  </span>
					  <input name="paddingLeft" type="text" class="bb-tiny-input bb-binddata" value="{{paddingLeft}}" placeholder="" />    
				   </div>
			   </div>
			</div>
			<?php
		}
		
		public function template_margin(){
			?>
			<div class="bb-responsive-margin bb-responsive-container" data-template="margin">
			   <div class="child-label"><?php esc_html_e('Margin', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Top', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-up-alt"></span> 
					  </span>
					  <input name="marginTop" type="text" class="bb-tiny-input bb-binddata" value="{{marginTop}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Right', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-right-alt"></span> 
					  </span>
					  <input name="marginRight" type="text" class="bb-tiny-input bb-binddata" value="{{marginRight}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Bottom', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-down-alt"></span> 
					  </span>
					  <input name="marginBottom" type="text" class="bb-tiny-input bb-binddata" value="{{marginBottom}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Left', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-left-alt"></span> 
					  </span>
					  <input name="marginLeft" type="text" class="bb-tiny-input bb-binddata" value="{{marginLeft}}" placeholder="" />    
				   </div>
			   </div>
			</div>
			<?php
		}
		
		public function template_background(){
			?>
			<div class="bb-responsive-background bb-responsive-container" data-template="background">
			   <div class="child-label"><?php esc_html_e('Background', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					   <div class="bb-upload-image {{ (backgroundImage!='')?'uploaded':'' }}"  data-image="{{backgroundImage}}" >
						  <span class="bb-btn-clear"><span class="dashicons dashicons-no"></span></span>
						  <span class="bb-btn-add"><span class="dashicons dashicons-plus"></span></span>
					 </div>
				   </div>
				   
				   <div class="bb-responsive-group-container">
					   <div class="bb-responsive-group-inside">
							 <div class="bb-responsive-group-inside">
								 <div class="bb-responsive-section">
									 <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Background Size', 'wpelite'); ?>">
										 <span class="dashicons dashicons-editor-help"></span> 
										 <?php esc_html_e('Background Size', 'wpelite'); ?>
									 </span>
									 <select name="backgroundSize" type="text" class="bb-tiny-input bb-binddata" data-value="{{backgroundSize}}">
										 <option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
										 <option value="auto"><?php esc_html_e('Auto', 'wpelite'); ?></option>
										 <option value="50%"><?php esc_html_e('50%', 'wpelite'); ?></option>
										 <option value="100% 100%"><?php esc_html_e('100% 100%', 'wpelite'); ?></option>
										 <option value="cover"><?php esc_html_e('Cover', 'wpelite'); ?></option>
										 <option value="contain"><?php esc_html_e('Contain', 'wpelite'); ?></option>
										 <option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
									 </select> 
								</div>
								 <div class="bb-responsive-section">
								   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Background Position', 'wpelite'); ?>">
									  <span class="dashicons dashicons-editor-help"></span> 
									  <?php esc_html_e('Background Position', 'wpelite'); ?>
								   </span>
								   <select name="backgroundPosition" type="text" class="bb-tiny-input bb-binddata" data-value="{{backgroundPosition}}">
										 <option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
										 <option value="left top"><?php esc_html_e('Left top', 'wpelite'); ?></option>
										 <option value="left center"><?php esc_html_e('Left center', 'wpelite'); ?></option>
										 <option value="left bottom"><?php esc_html_e('Left bottom', 'wpelite'); ?></option>
										 <option value="right top"><?php esc_html_e('Right top', 'wpelite'); ?></option>
										 <option value="right center"><?php esc_html_e('Right center', 'wpelite'); ?></option>
										 <option value="right bottom"><?php esc_html_e('Right bottom', 'wpelite'); ?></option>
										 <option value="center top"><?php esc_html_e('Center top', 'wpelite'); ?></option>
										 <option value="center center"><?php esc_html_e('Center center', 'wpelite'); ?></option>
										 <option value="center bottom"><?php esc_html_e('Center bottom', 'wpelite'); ?></option>
								   </select> 
								 </div>
							</div>
							<div class="bb-responsive-group-inside">
								<div class="bb-responsive-section">
								  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Background Repeat', 'wpelite'); ?>">
									 <span class="dashicons dashicons-editor-help"></span> 
									 <?php esc_html_e('Background Repeat', 'wpelite'); ?>
								  </span>
								  <select name="backgroundRepeat" type="text" class="bb-tiny-input bb-binddata" data-value="{{backgroundRepeat}}">
										<option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
										<option value="repeat"><?php esc_html_e('Repeat', 'wpelite'); ?></option>
										<option value="repeat-x"><?php esc_html_e('Repeat-x', 'wpelite'); ?></option>
										<option value="repeat-y"><?php esc_html_e('Repeat-y', 'wpelite'); ?></option>
										<option value="no-repeat"><?php esc_html_e('No-repeat', 'wpelite'); ?></option>
										<option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
										<option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
								  </select> 
								</div>
								 <div class="bb-responsive-section">
								   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Background Attachment', 'wpelite'); ?>">
									  <span class="dashicons dashicons-editor-help"></span> 
									  <?php esc_html_e('Background Attachment', 'wpelite'); ?>
								   </span>
								   <select name="backgroundAttachment" type="text" class="bb-tiny-input bb-binddata" data-value="{{backgroundAttachment}}">
										 <option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
										 <option value="scroll"><?php esc_html_e('Scroll', 'wpelite'); ?></option>
										 <option value="fixed"><?php esc_html_e('Fixed', 'wpelite'); ?></option>
										 <option value="local"><?php esc_html_e('Local', 'wpelite'); ?></option>
										 <option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
										 <option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
								   </select> 
								 </div>
							 </div>
							<div class="bb-responsive-section">
								<span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Background Color', 'wpelite'); ?>">
									<span class="dashicons dashicons-editor-help"></span> 
									<?php esc_html_e('Background Color', 'wpelite'); ?>
								</span>
								<input name="backgroundColor" type="text" class="bb-tiny-input bb-color-picker bb-binddata" value="{{backgroundColor}}" />    
							</div>
						</div>
					</div>	
			   
			   </div>
			 </div>
			<?php
		}
		
		public function template_border(){
			?>
			<div class="bb-responsive-border bb-responsive-container" data-template="border">
			   <div class="child-label"><?php esc_html_e('Border', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Top', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-up-alt"></span> 
					  </span>
					  <input name="borderTopWidth" type="text" class="bb-tiny-input bb-binddata" value="{{borderTopWidth}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Right', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-right-alt"></span> 
					  </span>
					  <input name="borderRightWidth" type="text" class="bb-tiny-input bb-binddata" value="{{borderRightWidth}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Bottom', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-down-alt"></span> 
					  </span>
					  <input name="borderBottomWidth" type="text" class="bb-tiny-input bb-binddata" value="{{borderBottomWidth}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Left', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-left-alt"></span> 
					  </span>
					  <input name="borderLeftWidth" type="text" class="bb-tiny-input bb-binddata" value="{{borderLeftWidth}}" placeholder="" />    
				   </div>
			   </div>
			   
			   <div class="bb-responsive-group-container bb-responsive-group-border">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Style', 'wpelite'); ?>">
						 <span class="dashicons dashicons-editor-help"></span> 
						 <?php esc_html_e('Border Style', 'wpelite'); ?>
					  </span>
					  <select name="borderStyle" type="text" class="bb-tiny-input bb-binddata" data-value="{{borderStyle}}">
							<option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
							<option value="dotted"><?php esc_html_e('Dotted', 'wpelite'); ?></option>
							<option value="dashed"><?php esc_html_e('Dashed', 'wpelite'); ?></option>
							<option value="solid"><?php esc_html_e('Solid', 'wpelite'); ?></option>
							<option value="double"><?php esc_html_e('Double', 'wpelite'); ?></option>
							<option value="groove"><?php esc_html_e('Groove', 'wpelite'); ?></option>
							<option value="ridge"><?php esc_html_e('Ridge', 'wpelite'); ?></option>
							<option value="none"><?php esc_html_e('None', 'wpelite'); ?></option>
							<option value="hidden"><?php esc_html_e('Hidden', 'wpelite'); ?></option>
							<option value="inset"><?php esc_html_e('Inset', 'wpelite'); ?></option>
							<option value="outset"><?php esc_html_e('Outset', 'wpelite'); ?></option>
							<option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
							<option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
					  </select> 
				   </div>
				   <div class="bb-responsive-section">
					   <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Color', 'wpelite'); ?>">
						  <span class="dashicons dashicons-editor-help"></span> 
						  <?php esc_html_e('Border Color', 'wpelite'); ?>
					   </span>
					   <input name="borderColor" type="text" class="bb-tiny-input bb-color-picker bb-binddata" value="{{borderColor}}" />    
					</div>
			   </div>	
			</div>
			<?php
		}
		
		public function template_border_radius(){
			?>
			<div class="bb-responsive-border bb-responsive-container" data-template="border-radius">
			   <div class="child-label"><?php esc_html_e('Border radius', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('TopLeft', 'wpelite'); ?>">
						 <span class="wphb-cst-rotate01 dashicons dashicons-arrow-up-alt2"></span>
					  </span>
					  <input name="borderTopLeftRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderTopLeftRadius}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('TopRight', 'wpelite'); ?>">
						 <span class="wphb-cst-rotate02 dashicons dashicons-arrow-up-alt2"></span>
					  </span>
					  <input name="borderTopRightRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderTopRightRadius}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('BottomRight', 'wpelite'); ?>">
						 <span class="wphb-cst-rotate03 dashicons dashicons-arrow-up-alt2"></span>
					  </span>
					  <input name="borderBottomRightRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderBottomRightRadius}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('BottomLeft', 'wpelite'); ?>">
						 <span class="wphb-cst-rotate04 dashicons dashicons-arrow-up-alt2"></span>
					  </span>
					  <input name="borderBottomLeftRadius" type="text" class="bb-tiny-input bb-binddata" value="{{borderBottomLeftRadius}}" placeholder="" />    
				   </div>
			   </div>
		   </div>
			<?php
		}
		
		public function template_display(){
			?>
			<div class="bb-responsive-display bb-responsive-container" data-template="display">
			   <div class="child-label"><?php esc_html_e('Display', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Display', 'wpelite'); ?>">
						<span class="dashicons dashicons-visibility"></span>
					  </span>
					  <select name="display" type="text" class="bb-tiny-input bb-binddata" data-value="{{display}}">
						  <option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
						  <option value="inline"><?php esc_html_e('Inline', 'wpelite'); ?></option>
						  <option value="block"><?php esc_html_e('Block', 'wpelite'); ?></option>
						  <option value="flex"><?php esc_html_e('Flex', 'wpelite'); ?></option>
						  <option value="inline-block"><?php esc_html_e('Inline-block', 'wpelite'); ?></option>
						  <option value="inline-flex"><?php esc_html_e('Inline-flex', 'wpelite'); ?></option>
						  <option value="inline-table"><?php esc_html_e('Inline-table', 'wpelite'); ?></option>
						  <option value="list-item"><?php esc_html_e('List-item', 'wpelite'); ?></option>
						  <option value="run-in"><?php esc_html_e('Run-in', 'wpelite'); ?></option>
						  <option value="table"><?php esc_html_e('Table', 'wpelite'); ?></option>
						  <option value="table-caption"><?php esc_html_e('Table-caption', 'wpelite'); ?></option>
						  <option value="table-column-group"><?php esc_html_e('Table-column-group', 'wpelite'); ?></option>
						  <option value="table-header-group"><?php esc_html_e('Table-header-group', 'wpelite'); ?></option>
						  <option value="table-footer-group"><?php esc_html_e('Table-footer-group', 'wpelite'); ?></option>
						  <option value="table-row-group"><?php esc_html_e('Table-row-group', 'wpelite'); ?></option>
						  <option value="table-cell"><?php esc_html_e('Table-cell', 'wpelite'); ?></option>
						  <option value="table-column"><?php esc_html_e('Table-column', 'wpelite'); ?></option>
						  <option value="table-row"><?php esc_html_e('Table-row', 'wpelite'); ?></option>
						  <option value="none"><?php esc_html_e('None', 'wpelite'); ?></option>
						  <option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
						  <option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
					  </select> 
				   </div>
			   </div>
			</div>
			<?php
		}
		
		public function template_width_height(){
			?>
			<div class="bb-responsive-width-height bb-responsive-container" data-template="width-height">
			   <div class="child-label"><?php esc_html_e('Width & Height', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Width', 'wpelite'); ?>">
						 <span class="dashicons dashicons-image-flip-horizontal"></span>
					  </span>
					  <input name="width" type="text" class="bb-tiny-input bb-binddata" value="{{width}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Height', 'wpelite'); ?>">
						 <span class="dashicons dashicons-image-flip-vertical"></span>
					  </span>
					  <input name="height" type="text" class="bb-tiny-input bb-binddata" value="{{height}}" placeholder="" />    
				   </div>
			   </div>
		   </div>
			<?php
		}
		
		public function template_max_width_height(){
			?>
			<div class="bb-responsive-max-width-height bb-responsive-container" data-template="max-width-height">
			   <div class="child-label"><?php esc_html_e('Max Width & Max Height', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Max Width', 'wpelite'); ?>">
						 <span class="dashicons dashicons-image-flip-horizontal"></span>
					  </span>
					  <input name="maxWidth" type="text" class="bb-tiny-input bb-binddata" value="{{maxWidth}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Max Height', 'wpelite'); ?>">
						 <span class="dashicons dashicons-image-flip-vertical"></span>
					  </span>
					  <input name="maxHeight" type="text" class="bb-tiny-input bb-binddata" value="{{maxHeight}}" placeholder="" />    
				   </div>
			   </div>
		   </div>
			<?php

	}

	public function template()
	{
		?>
			<script id="BESTBUG_EXTEND_VCPARAMS_RESPONSIVE" type="text/template">
				
				<?php $this->template_css_box(); ?>
				<?php $this->template_padding(); ?>
				<?php $this->template_margin(); ?>
				<?php $this->template_border(); ?>
				<?php $this->template_border_radius(); ?>
				<?php $this->template_background(); ?>
				<?php $this->template_font(); ?>
				<?php $this->template_display(); ?>
				<?php $this->template_width_height(); ?>
				<?php $this->template_max_width_height(); ?>
				<?php $this->template_position(); ?>
				<?php $this->template_selector(); ?>
				<input type="text" name="{{name}}" class="wpb_vc_param_value" value="{{value}}" />
				
			</script>
			<?php
		}
		
		public function template_position(){
			?>
			<div class="bb-responsive-position bb-responsive-container" data-template="position">
			   <div class="child-label"><?php esc_html_e('Position', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Position', 'wpelite'); ?>">
						<span class="dashicons dashicons-move"></span>
					  </span>
					  <select name="position" type="text" class="bb-tiny-input bb-binddata" data-value="{{position}}">
						  <option value=""><?php esc_html_e('Default', 'wpelite'); ?></option>
						  <option value="static"><?php esc_html_e('Static', 'wpelite'); ?></option>
						  <option value="absolute"><?php esc_html_e('Absolute', 'wpelite'); ?></option>
						  <option value="fixed"><?php esc_html_e('Fixed', 'wpelite'); ?></option>
						  <option value="relative"><?php esc_html_e('Relative', 'wpelite'); ?></option>
						  <option value="sticky"><?php esc_html_e('Sticky', 'wpelite'); ?></option>
						  <option value="initial"><?php esc_html_e('Initial', 'wpelite'); ?></option>
						  <option value="inherit"><?php esc_html_e('Inherit', 'wpelite'); ?></option>
					  </select> 
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Top', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-up-alt"></span> 
					  </span>
					  <input name="top" type="text" class="bb-tiny-input bb-binddata" value="{{top}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Right', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-right-alt"></span> 
					  </span>
					  <input name="right" type="text" class="bb-tiny-input bb-binddata" value="{{right}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Bottom', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-down-alt"></span> 
					  </span>
					  <input name="bottom" type="text" class="bb-tiny-input bb-binddata" value="{{bottom}}" placeholder="" />    
				   </div>
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Left', 'wpelite'); ?>">
						 <span class="dashicons dashicons-arrow-left-alt"></span> 
					  </span>
					  <input name="left" type="text" class="bb-tiny-input bb-binddata" value="{{left}}" placeholder="" />    
				   </div>
			   </div>
			</div>
			<?php
		}
		
		public function template_selector(){
			?>
			<div class="bb-responsive-selector bb-responsive-container" data-template="selector">
			   <div class="child-label"><?php esc_html_e('Selector', 'wpelite'); ?></div>
			   <div class="bb-responsive-group-container">
				   <div class="bb-responsive-section">
					  <span class="bb-field-icon bbhelp--top" bbhelp-label="<?php esc_html_e('Selector', 'wpelite'); ?>">
						<span class="dashicons dashicons-editor-code"></span>
					  </span>
					  <input name="selector" type="text" class="bb-tiny-input bb-normal-input bb-binddata" value="{{selector}}" placeholder="" />
					  <div class="bb-text-examples">
						  <span><em><?php esc_html_e('Example selector', 'wpelite') ?>:</em></span>
						  <span><a href="javascript:;" data-example="#class# *"><?php esc_html_e('All childs', 'wpelite') ?></a></span>, 
    					  <span><a href="javascript:;" data-example="#class# h1,#class# h2,#class# h3,#class# h4,#class# h5,#class# h6"><?php esc_html_e('Heading', 'wpelite') ?></a></span>, 
    					  <span><a href="javascript:;" data-example="#class# blockquote"><?php esc_html_e('Blockquote', 'wpelite') ?></a></span>, 
    					  <span><a href="javascript:;" data-example="#class# p"><?php esc_html_e('Text', 'wpelite') ?></a></span>, 
    					  <span><a href="javascript:;" data-example="#class# div"><?php esc_html_e('Block Content', 'wpelite') ?></a></span>, 
    					  <span><a href="javascript:;" data-example="#class# li"><?php esc_html_e('List', 'wpelite') ?></a></span>, 
						  <span><a href="javascript:;" data-example="#class# a"><?php esc_html_e('Link', 'wpelite') ?></a></span> ... 
						  <span><a href="https://www.w3schools.com/cssref/sel_element_element.asp" target="_blank"><em><?php esc_html_e('Read more', 'wpelite') ?></em></a></span>
					  </div>
				   </div>
			   </div>
			</div>
			<?php
		}
		
		public function save_post( $post_id ) {
			$post = get_post( $post_id );
			$this->post_css = get_post_meta( $post_id, '_wpb_shortcodes_custom_css', true );

			$this->build_css( $post->post_content );

			$this->update_css($post_id);
		}
		
		public function build_css( $content ) {
			if( !class_exists('WPBMap') ) {
				return;
			}
			if ( ! preg_match( '/\s*(\.[^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $content ) ) {
				return;
			}
			WPBMap::addAllMappedShortcodes();
			preg_match_all( '/' . get_shortcode_regex() . '/', $content, $shortcodes );
			foreach ( $shortcodes[2] as $index => $tag ) {

				$shortcode = WPBMap::getShortCode( $tag );
				$attr_array = shortcode_parse_atts( trim( $shortcodes[3][ $index ] ) );
				if ( isset( $shortcode['params'] ) && ! empty( $shortcode['params'] ) ) {
					foreach ( $shortcode['params'] as $param ) {

						if ( 'bb_responsive' === $param['type'] && isset( $attr_array[ $param['param_name'] ] )) {
								$responsive_css = str_replace("&gt;",">", $attr_array[ $param['param_name'] ]);
								
								do_action_ref_array( 'bb_build_css', array(&$param['param_name'], &$responsive_css) );
								
								$this->post_css .= $responsive_css;
						}
					}
				}
			}
			foreach ( $shortcodes[5] as $shortcode_content ) {
				$this->build_css( $shortcode_content );
			}

		}

		public function update_css($post_id) {
			$_POST = BestBug_Helper::sanitize_data($_POST);
			if ( ( isset( $_POST['wp-preview'] ) && 'dopreview' === $_POST['wp-preview'] ) ) {
				add_post_meta($post_id, '_bbrp_shortcodes_custom_css', $this->post_css);
				update_post_meta($post_id, '_bbrp_shortcodes_custom_css', $this->post_css);
			} else {
				update_post_meta($post_id, '_wpb_shortcodes_custom_css', $this->post_css);
			}
		}
		
	}

	new BestBug_Extend_VcParams_Responsive();
}
