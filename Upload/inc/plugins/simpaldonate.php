<?php
/*
 * MyBB: SimPal Donate
 *
 * File: simpaldonate.php
 * 
 * Authors: Vintagedaddyo
 *
 * MyBB Version: 1.8
 *
 * Plugin Version: 1.0
 * 
 */

// Disallow direct access to this file for security reasons

if(!defined('IN_MYBB'))
	die('This file cannot be accessed directly.');


$plugins->add_hook("index_end", "simpaldonate_show");

$plugins->add_hook("portal_end", "simpaldonate_show"); 

function simpaldonate_info()
{
    global $lang, $db, $mybb;

	$lang->load("simpaldonate");
	
	return array(
		"name"		=> $lang->name,
		"description"		=> $lang->desc,
		"website"		=> "",
		"author"		=> "Vintagedaddyo",
		"authorsite"		=> "",
		"version"		=> "1.0.0",
		"guid" 			=> "*",
		"compatibility"	=> "18*"
		);
}


function simpaldonate_install()
{
	global $mybb, $db, $lang;	

	$lang->load("simpaldonate");

	
	$settinggroups = array(
		'name' 			=> 'simpaldonate', 
		'title' 		=> $db->escape_string($lang->name),
		'description' 	=> $db->escape_string($lang->settings_desc),
		'disporder' 	=> '100', 
		'isdefault' 	=> '0'
	);

	$gid = $db->insert_query("settinggroups", $settinggroups);

	$disporder = '0';


	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatemail",
		"title"			=> $db->escape_string($lang->settings_donate_mail),
		"description"	=> $db->escape_string($lang->settings_donate_mail_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_mail_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);


	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatelimit",
		"title"			=> $db->escape_string($lang->settings_donate_limit),
		"description"	=> $db->escape_string($lang->settings_donate_limit_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_limit_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);

	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatebtnloc",
		"title"			=> $db->escape_string($lang->settings_donate_btnloc),
		"description"	=> $db->escape_string($lang->settings_donate_btnloc_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_btnloc_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);

	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonateloc",
		"title"			=> $db->escape_string($lang->settings_donate_loc),
		"description"	=> $db->escape_string($lang->settings_donate_loc_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_loc_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);


	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatecurr",
		"title"			=> $db->escape_string($lang->settings_donate_curr),
		"description"	=> $db->escape_string($lang->settings_donate_curr_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_curr_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);

	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatereas",
		"title"			=> $db->escape_string($lang->settings_donate_reas),
		"description"	=> $db->escape_string($lang->settings_donate_reas_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_reas_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);

	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatemessage1",
		"title"			=> $db->escape_string($lang->settings_donate_message1),
		"description"	=> $db->escape_string($lang->settings_donate_message1_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_message1_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);

	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatemessage2",
		"title"			=> $db->escape_string($lang->settings_donate_message2),
		"description"	=> $db->escape_string($lang->settings_donate_message2_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_message2_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);

	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatemessage3",
		"title"			=> $db->escape_string($lang->settings_donate_message3),
		"description"	=> $db->escape_string($lang->settings_donate_message3_desc),
		"optionscode"	=> "text",
		"value"			=> $db->escape_string($lang->settings_donate_message3_value),
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);

	$setting = array(
		"sid"			=> '0',
		"name"			=> "simpaldonatecoll",
		"title"			=> $db->escape_string($lang->settings_collapse),
		"description"	=> $db->escape_string($lang->settings_collapse_desc),
		"optionscode"	=> "yesno",
		"value"			=> '1',
		"disporder"		=> $disporder++,
		"gid"			=> $gid
	);

	$db->insert_query("settings", $setting);
	
	rebuild_settings(); 

	$template = array(
		"tid" 			=> "0",
		"title" 		=> "simpaldonate",
		"template"		=> $db->escape_string('<style type="text/css"></style>

		<table border="0" cellspacing="{$theme[\'borderwidth\']}" cellpadding="{$theme[\'tablespace\']}" class="tborder" style="clear: both; border-bottom-width: 0;">
<tr>
<td class="thead" colspan="1">
{$collapse}
<strong>{$lang->name}</strong>
</td>

</tr>
<tr>
<tbody style="{$expdisplay}" id="post-donate_e">
<td class="trow1">

<p align="center">{$mybb->settings[\'simpaldonatemessage1\']}</p>

<p align="center">{$mybb->settings[\'simpaldonatemessage2\']} ( {$mybb->settings[\'simpaldonatelimit\']}  {$mybb->settings[\'simpaldonatecurr\']} ) {$mybb->settings[\'simpaldonatemessage3\']}</p>



<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align: center">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="{$mybb->settings[\'simpaldonatemail\']}">
<input type="hidden" name="lc" value="{$mybb->settings[\'simpaldonateloc\']}">
<input type="hidden" name="item_name" value="{$mybb->settings[\'simpaldonatereas\']}">
<input type="hidden" name="no_note" value="0">
<input type="" name="amount" value="{$mybb->settings[\'simpaldonatelimit\']}">
<input type="hidden" name="currency_code" value="{$mybb->settings[\'simpaldonatecurr\']}">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<p>
<input type="image" src="https://www.paypal.com/{$mybb->settings[\'simpaldonatebtnloc\']}/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/{$mybb->settings[\'simpaldonatebtnloc\']}/i/scr/pixel.gif" width="1" height="1">
</p>
</form>


</td>
</tr>
</tbody></table><br />'),
		"sid" 			=> "-1", 
		);

	    $db->insert_query("templates", $template);

}


function simpaldonate_is_installed()
{
    global $db, $lang, $mybb;

	$lang->load("simpaldonate");
	
	$q = $db->simple_select('settinggroups', '*', 'name=\'simpaldonate\'');

	$group = $db->fetch_array($q);

	if($group === 0 || empty($group))
	return false;
	return true;
}

function simpaldonate_uninstall()
{
	global $mybb, $db, $lang;

	$lang->load("simpaldonate");
	
	$db->delete_query("settinggroups", "name = 'simpaldonate'");

	$db->delete_query('settings', 'name LIKE \'%simpaldonate%\'');

	$db->delete_query('templates', 'title LIKE (\'%simpaldonate%\')');

} 


function simpaldonate_show()
{
	global $db, $mybb, $page, $simpaldonate, $theme, $templates, $lang;

    $lang->load("simpaldonate");
	
		if($mybb->settings['simpaldonatecoll'] == '1')
		{

		$collapse = '<div class="expcolimage"><img src="images/collapse.png" id="post-donate_img" class="expander" alt="{$expaltext}" title="{$expaltext}" /></div>';

        }

	eval('$simpaldonate = "'.$templates->get('simpaldonate').'";');
}

?>