<?php
/*************************************************
*                                                *
*			Copy Right : Fun n Enjoy             *
*              Fun n Enjoy CMS lite              *
*                                                *
*************************************************/

if(!(defined("_no_direct"))){include("404.php");exit;}
$includes=array("session","config","db","Articles","menu");
foreach($includes as $a)
{
	require_once("includes/".$a.".php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitiona "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $meta_description; ?>" />
<title><?php echo $meta_title; ?> - मतदाता जागृति संगठन || Matdata Jagriti Sangthan</title>
<link rel="stylesheet" type="text/css" href="css.css" />
</head>
<body>
<div class="header" id="header">
<div align="left" class="h_logo inline-block">
<a href="/"><span class="m_logo" /><br /></a>
</div>

    <div style="display:inline-block; float:right;">
    <?php
/*	echo "Hi..! ".ucwords($_SESSION["name"]);
	exit;*/
	if(defined("LOGINED")){
	echo "Hi..! ".ucwords($_SESSION["name"]); ?><?php
		$a=$_SESSION["privilage"];
		if($a==1)echo "&nbsp;&lt;<a href=\"upd_art.php\">Edit Articles</a>&gt;&nbsp;&lt;<a href=\"addarticle.php\">Add Articles</a>&gt;&nbsp;&lt;<a href=\"manage_articles.php\">Delete/Manage Articles</a>&gt;&nbsp;&lt;<a href=\"manage_users.php\">Manage Users</a>&gt;";
		?>&nbsp;&lt;<a href="logout.php?xss_token=<?php echo $_SESSION["xss_token"]; ?>">Logout</a>&gt;<?php
	?>
<?php /*<div class="menu_cotainer">
	<span class="menu_trigger">More<span class="menu_t_icon mt_icon menu_t_icon_u"></span></span>
	<div class="menu_list_cont pop_ups absolute" align="left">
		<span class="menu_list"><a href="logout.php?xss_token=<?php echo $_SESSION["xss_token"]; ?>">Logout</a></span>
		<span class="menu_list">Fun n Enjoy</span>
		<span class="menu_list">Fun n Enjoy</span>
	</div>
</div>*/ ?>
    <?php	
	}
	else{
		?>
        <a class="btn" href="/l.php">Login</a>&nbsp;<a class="btn" href="/r.php">Register</a>
        <?php
	}
    ?>
<script type="text/javascript">var is_letter=true;</script>
</div>
<div class="menu-box block">
      <div class="navigation-pattern"></div>
      <a class="link-home" href="<?php echo BASE_URL; ?>"></a>
<div class="menu-menu-container"><ul id="nav" class="menu"><li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-2 current_page_item menu-item-54"><a href="<?php echo BASE_URL; ?>">मतदाता-संगठन | Matdata Sangthan</a></li>
<?php
$menu=new Menu();
$menu->article_links_html("menu-item menu-item-type-post_type menu-item-object-page");
?><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-63"><a title="Join Us By Filling a littel Form" href="register.php">Join Us</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-64"><a href="login.php">Login</a></li>
</ul>
</div></div></div>