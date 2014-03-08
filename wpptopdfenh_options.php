<script type="text/javascript">
    jQuery(document).ready(function() {
        // hides as soon as the DOM is ready
        jQuery('div.wpptopdfenh-option-body').hide();
        // shows on clicking the noted link
        jQuery('h3').click(function() {
            jQuery(this).toggleClass("open");
            jQuery(this).next("div").slideToggle('1000');
            return false;
        });
        jQuery('.button-secondary').click(function() {
            return confirm('Are you sure you want to clear the cache? This is not required if you have not changed any PDF Formatting Options.');
        });
    });
</script>
<div id="wpptopdfenh-options" class="wpptopdfenh-option wrap">
<div id="icon-options-general" class="icon32"><br></div>
<h2>WP Post to PDF Enhanced Options</h2>

<p>For detailed documentation visit <a target="_blank" title="WP Post to PDF Enhanced" rel="bookmark"
                                       href="http://www.2rosenthals.net/wordpress/help/general-help/wp-post-to-pdf-enhanced/">WP Post to PDF Enhanced</a>
</p>

<p>Feel free to comment, report issues, or request enhancements.</p>

<form method="post" action="options.php">
<?php settings_fields('wpptopdfenh_options');
$wpptopdfenhopts = get_option('wpptopdfenh'); ?>
<h3>Include/Exclude content types, posts, pages</h3>

<div class="wpptopdfenh-option-body">
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Allowed Custom Post Types</th>
            <td>
                <?php 
                $post_types = get_post_types(array('public'   => true),'names');
                foreach( $post_types as $post_type){ ?>
                    <input name="wpptopdfenh[<?php echo $post_type; ?>]"
                           value="1" <?php echo (isset($wpptopdfenhopts[$post_type])) ? 'checked="checked"' : ''; ?>
                           type="checkbox"/> <?php echo $post_type; ?><br/>
                <?php } ?>
                
                <p>Select custom post types where you want users to be able to generate PDF content.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Non Public Only</th>
            <td>
                <input name="wpptopdfenh[nonPublic]"
                       value="1" <?php echo (isset($wpptopdfenhopts['nonPublic'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you want to disable PDF content for public users. If selected, only logged in users
                    will be able to generate PDF content.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Only on Single</th>
            <td>
                <input name="wpptopdfenh[onSingle]"
                       value="1" <?php echo (isset($wpptopdfenhopts['onSingle'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you want to display the PDF icon only on a single page. If selected, the front page will not
                    display the PDF icon.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Include/Exclude</th>
            <td>
                <input name="wpptopdfenh[include]"
                       value="0" <?php echo ($wpptopdfenhopts['include']) ? '' : 'checked="checked"'; ?>
                       type="radio"/> Exclude the following&nbsp;&nbsp;&nbsp;
                <input name="wpptopdfenh[include]"
                       value="1" <?php echo ($wpptopdfenhopts['include']) ? 'checked="checked"' : ''; ?>
                       type="radio"/> Include the following
                <br/>
                <input type="text" name="wpptopdfenh[excludeThis]" id="wpptopdfenh[excludeThis]"
                       value="<?php echo ($wpptopdfenhopts['excludeThis']) ? $wpptopdfenhopts['excludeThis'] : ''; ?>"/>

                <p>Enter a list of comma-separated post/page IDs which you want to include/exclude from generating PDF content (show/hide PDF icon).<br/><span
                            class="wpptopdfenh-notice">To allow PDF content generation on all posts/pages, select "Exclude the following" and leave the textbox empty.</span></p>
            </td>
        </tr>

	    <tr valign="top">
            <th scope="row">Include/Exclude from Cache</th>
            <td>
                <input name="wpptopdfenh[includeCache]"
                       value="0" <?php echo ($wpptopdfenhopts['includeCache']) ? '' : 'checked="checked"'; ?>
                       type="radio"/> Exclude the following&nbsp;&nbsp;&nbsp;
                <input name="wpptopdfenh[includeCache]"
                       value="1" <?php echo ($wpptopdfenhopts['includeCache']) ? 'checked="checked"' : ''; ?>
                       type="radio"/> Include the following
                <br/>
                <input type="text" name="wpptopdfenh[excludeThisCache]" id="wpptopdfenh[excludeThisCache]"
                       value="<?php echo ($wpptopdfenhopts['excludeThisCache']) ? $wpptopdfenhopts['excludeThisCache'] : ''; ?>"/>

                <p>Enter a list of comma-separated post/page IDs for which you want to disable PDF caching.
	                The PDF will be generated on the fly when requested for these posts/pages. This is useful when
	                the content of your post(s)/page(s) is/are updated frequently by another plugin (e.g., "RSS in Page").<br/><span
                            class="wpptopdfenh-notice">To use caching on all posts/pages, select "Exclude the following" and leave the textbox empty.</span></p>
            </td>
        </tr>

    </table>
</div>
<h3>PDF icon/link presentation</h3>

<div class="wpptopdfenh-option-body">
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Icon Position</th>
            <td>
                <?php
                      $iconPosition = array('Before' => 'before', 'After' => 'after', 'Before and After' => 'beforeandafter', 'Manual' => 'manual');
                echo '<select name="wpptopdfenh[iconPosition]">';
                foreach ($iconPosition as $key => $value) {
                    if ($wpptopdfenhopts['iconPosition'])
                        $checked = ($wpptopdfenhopts['iconPosition'] == $value) ? 'selected="selected"' : '';
                    echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
                }
                echo '</select>';
                ?><br/>
                <?php
                      $iconLeftRight = array('Left' => 'left', 'Right' => 'right');
                echo '<select name="wpptopdfenh[iconLeftRight]">';
                foreach ($iconLeftRight as $key => $value) {
                    if ($wpptopdfenhopts['iconPosition'])
                        $checked = ($wpptopdfenhopts['iconLeftRight'] == $value) ? 'selected="selected"' : '';
                    echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
                }
                echo '</select>';
                ?>
                <p>Select where to place the PDF icon (before or after content; left or right aligned). <br/><span class="wpptopdfenh-notice">If you select manual, the left/right alignment setting will be ignored. Use following code within your theme
          to place the icon in the desired location:</span><br/>
                    <code><?php echo htmlentities('<?php if (function_exists("wpptopdfenh_display_icon")) echo wpptopdfenh_display_icon();?>'); ?></code><br/>
                </p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">PDF Download Icon</th>
            <td>
                <textarea id="imageIconSrc"
                          name="wpptopdfenh[imageIcon]"><?php echo ($wpptopdfenhopts['imageIcon']) ? $wpptopdfenhopts['imageIcon'] : '<img alt="Download PDF" src="' . WPPTOPDFENH_URL . '/asset/images/pdf.png">'; ?></textarea>

                <p>Enter the content you would like to display for the PDF download icon (you may use HTML). <br/><span
                        class="wpptopdfenh-notice">Use the following code in the textbox above for the included PDF icon.</span><br/><code><?php echo htmlentities('<img alt="Download PDF" src="' . WPPTOPDFENH_URL . '/asset/images/pdf.png">');  ?></code>
                </p>
            </td>
        </tr>
    </table>
</div>
<h3>PDF Formatting - General</h3>

<div class="wpptopdfenh-option-body">
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Other Plugins</th>
            <td>
                <input name="wpptopdfenh[otherPlugin]"
                       value="1" <?php echo (isset($wpptopdfenhopts['otherPlugin'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to include formatting applied by other plugins in the PDF.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Process Shortcodes</th>
            <td>
                <input name="wpptopdfenh[processShortcodes]"
                       value="1" <?php echo (isset($wpptopdfenhopts['processShortcodes'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to process shortcodes and display their results in the PDF.</p>
            </td>
        </tr>
       <?php $author = array('None' => '', 'Username' => 'user_nicename', 'Display Name' => 'display_name', 'Nickname' => 'nickname'); ?>
        <tr valign="top">
            <th scope="row">Display Author Detail</th>
            <td>
                <?php
                      echo '<select name="wpptopdfenh[authorDetail]">';
                    foreach ($author as $key => $value) {
                        if ($wpptopdfenhopts['authorDetail'] == '') { 'selected="None"';
                            $checked = ($wpptopdfenhopts['authorDetail'] == $value) ? 'selected="selected"' : '';
                        echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';

                        }
	                else {

                        if ($wpptopdfenhopts['authorDetail'])
                            $checked = ($wpptopdfenhopts['authorDetail'] == $value) ? 'selected="selected"' : '';
                        echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
			}
                    }
 
                    echo '</select>';
                    ?>
                    <p>Select if you would like to include the author's name in the PDF, and how it should be formatted.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Display Post Category List</th>
            <td>
                <input name="wpptopdfenh[postCategories]"
                       value="1" <?php echo (isset($wpptopdfenhopts['postCategories'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to include the post category list in the PDF.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Display Post Tag List</th>
            <td>
                <input name="wpptopdfenh[postTags]"
                       value="1" <?php echo (isset($wpptopdfenhopts['postTags'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to include the post tag list in the PDF.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Display Post Date</th>
            <td>
                <input name="wpptopdfenh[postDate]"
                       value="1" <?php echo (isset($wpptopdfenhopts['postDate'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to include the post date in the PDF.</p>
            </td>
        </tr>
        <tr valign="top">
	</table>
</div>
<h3>PDF Formatting - Header</h3>

<div class="wpptopdfenh-option-body">
    <table class="form-table">
       <?php $header = array('Suppressed' => '2', 'First Page Only' => '1', 'All Pages' => '0'); ?>
        <tr valign="top">
            <th scope="row">Header Display</th>
            <td>
                <?php
                      echo '<select name="wpptopdfenh[headerAllPages]">';
                    foreach ($header as $key => $value) {
                        if ($wpptopdfenhopts['headerAllPages'] == '') { 'selected="All Pages"';
                            $checked = ($wpptopdfenhopts['headerAllPages'] == $value) ? 'selected="selected"' : '';
                        echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';

                        }
	                else {

                        if ($wpptopdfenhopts['headerAllPages'])
                            $checked = ($wpptopdfenhopts['headerAllPages'] == $value) ? 'selected="selected"' : '';
                        echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
			}
                    }
 
                    echo '</select>';
                    ?>
                    <p>Select if you would like to include the header in the PDF, and whether it should be on all pages or just the first page (default is All Pages).</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Header Logo Image</th>
            <td>
                <input name="wpptopdfenh[headerlogoImage]"
                       value="1" <?php echo (isset($wpptopdfenhopts['headerlogoImage'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to display the logo image in the PDF header. It will be displayed in the upper left of the header.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"></th>
            <td>
                <?php if (file_exists(WP_CONTENT_DIR . '/uploads/wp-post-to-pdf-enhanced-logo.png')) { ?>
                <img src="<?php echo WP_CONTENT_URL . '/uploads/wp-post-to-pdf-enhanced-logo.png'; ?>"
                     alt="<?php bloginfo('name');?>"/>
                <p>To change this image, replace it here
                    '<?php echo WP_CONTENT_DIR . '/uploads/wp-post-to-pdf-enhanced-logo.png'; ?>'</p>
                <?php

            }
            else {
                ?>
                <p><span
                        class="wpptopdfenh-notice">Logo image not found. Please upload it to  '<?php echo WP_CONTENT_DIR . '/uploads/wp-post-to-pdf-enhanced-logo.png'; ?>
                    '.</span></p>
                <?php } ?>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Header Logo Image Factor</th>
            <td>
                <input type="text" name="wpptopdfenh[headerlogoImageFactor]" id="wpptopdfenh[headerlogoImageFactor]"
                       value="<?php echo ($wpptopdfenhopts['headerlogoImageFactor']) ? $wpptopdfenhopts['headerlogoImageFactor'] : '14'; ?>"/>

                <p>Enter your desired factor to be applied to the logo (default is 14). This is applied to logo width/logo height, to provide space around the logo image. It <em>will</em> adjust the overall size of the logo as well as the surrounding space.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Header Margin</th>
            <td>
                <input type="text" name="wpptopdfenh[marginHeader]" id="wpptopdfenh[marginHeader]"
                       value="<?php echo ($wpptopdfenhopts['marginHeader']) ? $wpptopdfenhopts['marginHeader'] : '5'; ?>"/>

                <p>Enter your desired top margin for the header (default is 5).</p>
            </td>
        </tr>
	</table>
</div>
<h3>PDF Formatting - Content</h3>

<div class="wpptopdfenh-option-body">
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Display Featured Image</th>
            <td>
                <input name="wpptopdfenh[featuredImage]"
                       value="1" <?php echo (isset($wpptopdfenhopts['featuredImage'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to display the featured image in the PDF header. If a featured image has been set for the particular post/page, it will be displayed just below the title.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Image Scaling Ratio</th>
            <td>
                <input type="text" name="wpptopdfenh[imageScale]" id="wpptopdfenh[imageScale]"
                       value="<?php echo ($wpptopdfenhopts['imageScale']) ? $wpptopdfenhopts['imageScale'] : '1.25'; ?>"/>

                <p>Enter your desired image scaling ratio as a decimal (default is 1.25). This represents the relative size of the image in the browser vs the size of the image in the PDF. Thus, 1.25 yields a 1.25:1 scale of web:PDF.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Custom CSS</th>
            <td>
                <input name="wpptopdfenh[applyCSS]"
                       value="1" <?php echo (isset($wpptopdfenhopts['applyCSS'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to apply a custom css to all PDFs generated.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"></th>
            <td>
                <textarea id="customCssSrc"
                          name="wpptopdfenh[customCss]"><?php echo ($wpptopdfenhopts['customCss']) ? $wpptopdfenhopts['customCss'] : '' ?></textarea>

                <p>Use the editor above to create or edit custom css to be applied to all PDFs.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Top Margin</th>
            <td>
                <input type="text" name="wpptopdfenh[marginTop]" id="wpptopdfenh[marginTop]"
                       value="<?php echo ($wpptopdfenhopts['marginTop']) ? $wpptopdfenhopts['marginTop'] : '27'; ?>"/>

                <p>Enter your desired top margin (default is 27).</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Left Margin</th>
            <td>
                <input type="text" name="wpptopdfenh[marginLeft]" id="wpptopdfenh[marginLeft]"
                       value="<?php echo ($wpptopdfenhopts['marginLeft']) ? $wpptopdfenhopts['marginLeft'] : '15'; ?>"/>

                <p>Enter your desired left margin (default is 15).</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Right Margin</th>
            <td>
                <input type="text" name="wpptopdfenh[marginRight]" id="wpptopdfenh[marginRight]"
                       value="<?php echo ($wpptopdfenhopts['marginRight']) ? $wpptopdfenhopts['marginRight'] : '15'; ?>"/>

                <p>Enter your desired right margin (default is 15).</p>
            </td>
        </tr>
	</table>
</div>
<h3>PDF Formatting - Footer</h3>

<div class="wpptopdfenh-option-body">
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Custom Footer</th>
            <td>
                <input name="wpptopdfenh[customFooter]"
                       value="1" <?php echo (isset($wpptopdfenhopts['customFooter'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like to use custom footer content on all PDFs.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row"></th>
            <td>
                <textarea id="customFooterText"
                          name="wpptopdfenh[customFooterText]"><?php echo ($wpptopdfenhopts['customFooterText']) ? $wpptopdfenhopts['customFooterText'] : '' ?></textarea>

                <p>Use the editor above to create or edit custom footer content to be added to all PDFs.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Cell Width</th>
            <td>
                <input type="text" name="wpptopdfenh[footerWidth]" id="wpptopdfenh[footerWidth]"
                       value="<?php echo ($wpptopdfenhopts['footerWidth']) ? $wpptopdfenhopts['footerWidth'] : '0'; ?>"/>

                <p>Enter your desired width (in mm) for the footer cell (default is 0mm). If 0, the cell extends up to the right margin.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Cell Minimum Height</th>
            <td>
                <input type="text" name="wpptopdfenh[footerMinHeight]" id="wpptopdfenh[footerMinHeight]"
                       value="<?php echo ($wpptopdfenhopts['footerMinHeight']) ? $wpptopdfenhopts['footerMinHeight'] : '0'; ?>"/>

                <p>Enter your desired minimum height (in mm) for the footer cell (default is 0mm). The cell extends automatically if needed.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Cell Upper Left Corner (X)</th>
            <td>
                <input type="text" name="wpptopdfenh[footerX]" id="wpptopdfenh[footerX]"
                       value="<?php echo ($wpptopdfenhopts['footerX']) ? $wpptopdfenhopts['footerX'] : '10'; ?>"/>

                <p>Enter your desired positioning (offset in mm from left margin) for the upper left corner of the footer cell (X coordinate; default is 10mm).</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Cell Upper Left Corner (Y)</th>
            <td>
                <input type="text" name="wpptopdfenh[footerY]" id="wpptopdfenh[footerY]"
                       value="<?php echo ($wpptopdfenhopts['footerY']) ? $wpptopdfenhopts['footerY'] : '270'; ?>"/>

                <p>Enter your desired positioning (offset in mm from top margin) for the upper left corner of the footer cell (Y coordinate; default is 270mm).</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Cell Border</th>
            <td>
                <input type="text" name="wpptopdfenh[footerCellBorder]" id="wpptopdfenh[footerCellBorder]"
                       value="<?php echo ($wpptopdfenhopts['footerCellBorder']) ? $wpptopdfenhopts['footerCellBorder'] : ''; ?>"/>

                <p>Enter your desired border for the footer cell (default is none). Valid entries are:<br/>
                	<li>1: renders a frame</li>
                	or a string containing some or all of the following characters (in any order):<br/>
                	<li>L: left border</li>
                	<li>T: top border</li>
                	<li>R: right border</li>
                	<li>B: bottom border</li>
                	<span class="wpptopdfenh-notice">or an array of line styles for each border group:</span><br/>
                	<code>array('LTRB' => array('width' => 2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)))</code></p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Cell Fill</th>
            <td>
		<input name="wpptopdfenh[footerFill]"
                       value="1" <?php echo (isset($wpptopdfenhopts['footerFill'])) ? 'checked="checked"' : ''; ?>
                       type="checkbox"/>

                <p>Select if you would like the footer cell to be painted (default is no).</p>
            </td>
        </tr>

       <?php $footeralign = array('Auto' => '', 'Left' => 'L', 'Right' => 'R', 'Center' => 'C'); ?>
        <tr valign="top">
            <th scope="row">Footer Cell Text Alignment</th>
            <td>
		<?php
			echo '<select name="wpptopdfenh[footerAlign]">';
			foreach ($footeralign as $key => $value) {
                        if ($wpptopdfenhopts['footerAlign'])
                        	$checked = ($wpptopdfenhopts['footerAlign'] == $value) ? 'selected="selected"' : '';
                        	echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
				}
			echo '</select>';
		?>
                <p>Select your desired text alignment for the footer cell (default is auto left-to-right or right-to-left).</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Cell Auto-padding</th>
            <td>
		<input name="wpptopdfenh[footerPad]"
                       value="1" <?php echo (isset($wpptopdfenhopts['footerPad'])) ? '' : 'checked="checked"'; ?>
                       type="checkbox"/>

                <p>Select if you would like to automatically adjust internal padding to account for line width (default is yes).</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Margin</th>
            <td>
                <input type="text" name="wpptopdfenh[marginFooter]" id="wpptopdfenh[marginFooter]"
                       value="<?php echo ($wpptopdfenhopts['marginFooter']) ? $wpptopdfenhopts['marginFooter'] : '10'; ?>"/>

                <p>Enter your desired bottom margin for the footer (default is 10). This is the minimum distance between the footer and the bottom page margin.</p>
            </td>
        </tr>
	</table>
</div>
<h3>PDF Formatting - Typography</h3>

<div class="wpptopdfenh-option-body">
    <table class="form-table">

        <?php $fonts = array(
	    'Al Arabiya' => 'aealarabiya',
	    'Furat' => 'aefurat',
	    'Arial' => 'helvetica',
	    'Arial Bold' => 'helveticab',
	    'Arial Bold Italic' => 'helveticabi',
	    'Arial Italic' => 'helveticai',
	    'Courier' => 'courier',
	    'Courier Bold' => 'courierb',
	    'Courier Bold Italic' => 'courierbi',
	    'Courier Italic' => 'courieri',
	    'DejaVu Sans' => 'dejavusans',
	    'DejaVu Sans Bold' => 'dejavusansb',
	    'DejaVu Sans Bold Italic' => 'dejavusansbi',
	    'DejaVu Sans Condensed' => 'dejavusanscondensed',
	    'DejaVu Sans Condensed Bold' => 'dejavusanscondensedb',
	    'DejaVu Sans Condensed Bold Italic' => 'dejavusanscondensedbi',
	    'DejaVu Sans Condensed Italic' => 'dejavusanscondensedi',
	    'DejaVu Sans Extra Light' => 'dejavusansextralight',
	    'DejaVu Sans Italic' => 'dejavusansi',
	    'DejaVu Sans Mono' => 'dejavusansmono',
	    'DejaVu Sans Mono Bold' => 'dejavusansmonob',
	    'DejaVu Sans Mono Bold Italic' => 'dejavusansmonobi',
	    'DejaVu Sans Mono Italic' => 'dejavusansmonoi',
	    'DejaVu Serif' => 'dejavuserif',
	    'DejaVu Serif Bold' => 'dejavuserifb',
	    'DejaVu Serif Bold Italic' => 'dejavuserifbi',
	    'DejaVu Serif Condensed' => 'dejavuserifcondensed',
	    'DejaVu Serif Condensed Bold' => 'dejavuserifcondensedb',
	    'DejaVu Serif Condensed Bold Italic' => 'dejavuserifcondensedbi',
	    'DejaVu Serif Condensed Italic' => 'dejavuserifcondensedi',
	    'DejaVu Serif Italic' => 'dejavuserifi',
	    'Free Mono' => 'freemono',
	    'Free Mono Bold' => 'freemonob',
	    'Free Mono Bold Italic' => 'freemonobi',
	    'Free Mono Italic' => 'freemonoi',
	    'Free Sans' => 'freesans',
	    'Free Sans Bold' => 'freesansb',
	    'Free Sans Bold Italic' => 'freesansbi',
	    'Free Sans Italic' => 'freesansi',
	    'Free Serif' => 'freeserif',
	    'Free Serif Bold' => 'freeserifb',
	    'Free Serif Bold Italic' => 'freeserifbi',
	    'Free Serif Italic' => 'freeserifi',
	    'Helvetica' => 'helvetica',
	    'Helvetica Bold' => 'helveticab',
	    'Helvetica Bold Italic' => 'helveticabi',
	    'Helvetica Italic' => 'helveticai',
	    'Kozuka Gothic Pro (Japanese Sans-Serif)' => 'kozgopromedium',
	    'Kozuka Mincho Pro (Japanese Serif)' => 'kozminproregular',
	    'MSung Light (Trad. Chinese)' => 'msungstdlight',
	    'MyungJo Medium (Korean)' => 'hysmyeongjostdmedium',
	    'PDF/A Courier' => 'pdfacourier',
	    'PDF/A Courier Bold' => 'pdfacourierb',
	    'PDF/A Courier Bold Italic' => 'pdfacourierbi',
	    'PDF/A Courier Italic' => 'pdfacourieri',
	    'PDF/A Helvetica' => 'pdfahelvetica',
	    'PDF/A Helvetica Bold' => 'pdfahelveticab',
	    'PDF/A Helvetica Bold Italic' => 'pdfahelveticabi',
	    'PDF/A Helvetica Italic' => 'pdfahelveticai',
	    'PDF/A Symbol' => 'pdfasymbol',
	    'PDF/A Times Roman' => 'pdfatimes',
	    'PDF/A Times Bold' => 'pdfatimesb',
	    'PDF/A Times Bold Italic' => 'pdfatimesbi',
	    'PDF/A Times Italic' => 'pdfatimesi',
	    'PDF/A ZapfDingbats' => 'pdfazapfdingbats',
	    'STSong Light (Simp. Chinese)' => 'stsongstdlight',
	    'Symbol' => 'symbol',
	    'Times Roman' => 'times',
	    'Times Bold' => 'timesb',
	    'Times Bold Italic' => 'timesbi',
	    'Times Italic' => 'timesi',
	    'ZapfDingbats' => 'zapfdingbats'
	    ); ?>
        <tr valign="top">
            <th scope="row">Header Font</th>
            <td>
                <?php
                      echo '<select name="wpptopdfenh[headerFont]">';
                    foreach ($fonts as $key => $value) {
                        if ($wpptopdfenhopts['headerFont'])
                            $checked = ($wpptopdfenhopts['headerFont'] == $value) ? 'selected="selected"' : '';
                        echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
                    }
                    echo '</select>';
                    ?>
                    <p>Select a font for the header.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Header Font Size</th>
            <td>
                <input type="text" name="wpptopdfenh[headerFontSize]" id="wpptopdfenh[headerFontSize]"
                       value="<?php echo ($wpptopdfenhopts['headerFontSize']) ? $wpptopdfenhopts['headerFontSize'] : '10'; ?>"/>

                <p>Enter the font size for header.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Font</th>
            <td>
                <?php
                      echo '<select name="wpptopdfenh[footerFont]">';
                    foreach ($fonts as $key => $value) {
                        if ($wpptopdfenhopts['footerFont'])
                            $checked = ($wpptopdfenhopts['footerFont'] == $value) ? 'selected="selected"' : '';
                        echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
                    }
                    echo '</select>';
                    ?>
                    <p>Select a font for the footer.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Footer Font Size</th>
            <td>
                <input type="text" name="wpptopdfenh[footerFontSize]" id="wpptopdfenh[footerFontSize]"
                       value="<?php echo ($wpptopdfenhopts['footerFontSize']) ? $wpptopdfenhopts['footerFontSize'] : '10'; ?>"/>

                <p>Enter the font size for the footer.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Content Font</th>
            <td>
                <?php
                    echo '<select name="wpptopdfenh[contentFont]">';
                    foreach ($fonts as $key => $value) {
                        if ($wpptopdfenhopts['contentFont'])
                            $checked = ($wpptopdfenhopts['contentFont'] == $value) ? 'selected="selected"' : '';
                        echo '<option value="' . $value . '" ' . $checked . ' >' . $key . '</option>';
                    }
                    echo '</select>';
                    ?>
                    <p>Select the default monospaced font.</p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Content Font Size</th>
            <td>
                <input type="text" name="wpptopdfenh[contentFontSize]" id="wpptopdfenh[contentFontSize]"
                       value="<?php echo ($wpptopdfenhopts['contentFontSize']) ? $wpptopdfenhopts['contentFontSize'] : '12'; ?>"/>

                <p>Enter the font size for the main content.</p>
            </td>
        </tr>
    </table>
</div>
<p class="submit">
    <input type="submit" class="button-primary" name="wpptopdfenh[submit]" value="<?php _e('Save Changes') ?>"/>
    <input type="submit" class="button-secondary" name="wpptopdfenh[submit]"
           value="<?php _e('Save and Reset PDF Cache') ?>"/>
</p>
</form>
<h4>If you find this plugin useful, <a target="_blank" title="Will open in new window" href="http://wordpress.org/extend/plugins/wp-post-to-pdf-enhanced/">please review and rate it</a>.</h4>
</div>