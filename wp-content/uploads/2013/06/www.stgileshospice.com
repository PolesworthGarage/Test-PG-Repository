<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/layout_portal.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>St Giles Hospice : Welcome To St Giles Hospice</title>
<meta name="description" content="St Giles Hospice, a registered charity, offers  specialist  care in a variety of settings for patients with cancer and other serious illnesses, as well as providing support for their families and helpers. The care is provided free of charge, irrespective of personal circumstances" /> 
<link rel="stylesheet" href="js/reveal.css">
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js" type="text/javascript"></script>
<script src="jcarousellite_1.0.1c4.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
		$(".newsticker").load("rsstest.asp",function() {
		$(".newsticker").jCarouselLite({
      	btnNext: ".next",
        btnPrev: ".prev",
        vertical: true
	  });
  });
		});
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<!-- InstanceBeginEditable name="head" -->
<script src="js/jquery.reveal.js" type="text/javascript"></script>
<script src="js/cyclelite.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#headerbanner').cycle();
});
</script>
<!--<script type="text/javascript">
$(document).ready(function() {
	$('#myModal').reveal(); 
});
</script>-->
<style type="text/css">
#content {
	background: #FFFFFF url(images/home_cont_bkgrd.gif) no-repeat top left;
}
#paypal {
	display: none;	
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceParam name="Slideshow_Header" type="boolean" value="false" -->
<!-- InstanceParam name="Normal_Header" type="boolean" value="true" -->
</head>

<body onload="MM_preloadImages('images/twitter_hover.gif','images/facebook_hover.gif','images/scrollup_hover.png','images/scrolldwn_hover.png')">
<div id="wrapper"><!-- InstanceBeginEditable name="EditRegion6" -->
<div id="header"  class="homepage">
<div id="headerbanner">
<img src="images/banners/banner.jpg" alt="St Giles Hospice Is 30" />
<img src="images/banners/banner2.jpg" alt="St Giles Is Hospice 30" />
<img src="images/banners/banner3.jpg" alt="St Giles Is Hospice 30" />
<img src="images/banners/banner4.jpg" alt="St Giles Hospice Is 30" />
<img src="images/banners/banner5.jpg" alt="St Giles Is Hospice 30" />
<img src="images/banners/banner6.jpg" alt="St Giles Hospice Is 30" />
<img src="images/banners/banner7.jpg" alt="St Giles Is Hospice 30" />
</div><!--end of headerbanner-->
<div id="headerlogo"><a href="index.html"><img src="images/30logo.png" class="logo" border="0"  /></a></div>
<div id="searchbox"><form action="search/search_template.php" method="get" name="searchform" target="_self" id="searchform" style="margin-bottom: 0"> <input type="hidden" name="include" value=""><input id="search1" class="searchbox" type="text" name="q" onfocus="if(this.value=='Enter Keyword...'){this.value=''};" onblur="if(this.value==''){this.value='Enter Keyword...'};" value="Enter Keyword..." size="16"><input name="Go" value="Go" type="image" src="images/search_but.gif" class="searchbut"/></form></div>
  <div class="clear"></div>
</div>
<!--end of header-->
<!-- InstanceEndEditable -->
<div id="nav"><img src="images/left_mainnav.gif" align="left" />
<ul>
<li><a href="index.html">Home</a></li>
<li><a href="about.html">About Us</a></li>
<li><a href="http://www.stgileshospice.com/main-news">Blog/News</a></li>
<li><a href="links.html">Links</a></li>
<!--<li><a href="#nogo">FAQ's</a></li>-->
<li><a href="info_professionals/working.html">Recruitment</a></li>
<li><a href="info_professionals/education_courses.html">Education &amp; Training</a></li>
<li class="last"><a href="contact.html">Contact Us</a></li>
</ul>
<img src="images/right_mainnav.gif" width="3" height="43" align="right" /></div><!--end of nav-->
<div id="breadcrumbs">
You are here: <span class="breadcrumb"><!-- InstanceBeginEditable name="breadcrumbs" -->Welcome to St Giles Hospice<!-- InstanceEndEditable --></span></div><!--end of breadcrumbs-->
<div id="content"><!-- InstanceBeginEditable name="content" --><div id="leftcontent">
<h2>Welcome to <strong>St Giles Hospice</strong></h2>
<p>St Giles Hospice, a registered charity, offers  specialist  care in a variety of settings for patients with cancer and other serious illnesses, as well as providing support for their families and helpers. The care is provided free of charge, irrespective of personal circumstances. </p>
<p>Care is offered at the hospice’s facilities in Sutton Coldfield, Walsall and Whittington, between Lichfield and Tamworth, and in patients’ own homes across the region.
</p>
<div id="category_container"> <a href="http://stgileshospice.com/30.html"><img src="images/30years_anniversary_banner.png" alt="St Giles Hospice 30 Years Of Caring" style="display: block; border: 0px; margin: 0px auto 10px;"  /></a>
<div class="category"><a href="about.html"><img src="images/find_out_more1.jpg" alt="Find out more about St Giles Hospice" name="find" width="312" height="194" border="0" id="find" /></a></div>
<div class="category"><a href="support_our_work/index.html"><img src="images/support_our_work1.jpg" alt="Support our work at St Giles Hospice" name="support" border="0" id="support"  /></a></div>
<div class="category"><a href="info_patients/index.html"><img src="images/info4patients1.jpg" alt="Information for patients" name="forpatients" width="312" height="194" border="0" id="forpatients" /></a></div>
<div class="category"><a href="info_professionals/index.html"><img src="images/info4professionals.jpg" alt="Information for professionals" name="forprofessionals" border="0" id="forprofessionals" /></a></div>
<!--end of categorybanner-->
</div><!--end of category_container-->
</div><!--end of leftcontent-->
<div id="sidebar">
<div id="latestnews">
<div id="scrollbuts">
<img src="images/scrollup.png" name="scrollup" border="0" alt="Scroll Up" class="prev" id="scrollup" onmouseover="MM_swapImage('scrollup','','images/scrollup_hover.png',1)" onmouseout="MM_swapImgRestore()" /><img src="images/scrolldwn.png" name="scrolldwn" class="next" alt="Scroll Down" id="scrolldwn" onmouseover="MM_swapImage('scrolldwn','','images/scrolldwn_hover.png',1)" onmouseout="MM_swapImgRestore()"/></div>
<div id="newsfeeds">
    <div class="newsticker">
		<ul style="margin-bottom: 0">

			</ul>
          </div>
</div><!--End of newsfeeds-->
</div><!--End of latestnews-->
<div class="clear"></div>
<div class="links"><a href="http://www.justgiving.com/stgileshospice/donate" target="_blank"><img src="images/Donate_online_butt_sidebar.png" alt="Donation Online button"  border="0"/></a> 
<!--  <a href="http://www.stgileshospice.com/support_our_work/fundraising/Lightupalife.html" target="_blank"><img src="images/Light-up-a-life-4.jpg" alt="Remember A Loved One with Light Up A Life" /></a>-->
<a href="http://www.stgileshospice.com/support_our_work/lottery/lotterymembership.asp" target="_blank"><img src="images/gen_lottery.jpg" alt="St Giles Lottery" border="0" /></a>
<!--<a href="http://www.stgileshospice.com/support_our_work/StGilesHospiceShops-ChristmasCards.html"  target="_blank"><img src="images/christmascards2013.jpg" alt="St Giles Christmas Card 2013" border="0" /></a>--><a href="http://www.stgileshospice.com/support_our_work/join_fundraising_event.html"  target="_blank"><img src="support_our_work/images/30TH_anniv_butt.jpg" alt="30th Anniversary Fundraising Events" border="0" /></a>
<!--<a href="http://www.stgileshospice.com/support_our_work/join_fundraising_event.html"  target="_blank"><img src="images/sections/challengeevents.jpg" alt="Challenges and Events For 2012" border="0" /></a>--><a href="http://www.stgilescareagency.co.uk" target="_blank"><img src="images/StGiles_care_butt.jpg" alt="St Giles Care Agency" border="0"/></a>
<a href="http://www.stgileshospice.com/support_our_work/donating_goods.html"><img src="images/sections/donateshops.jpg" alt="Donate To the St Giles Hospice Shops" /></a>
<a href="newsletter.html"><img src="images/newsletter.png" alt="Signup to our newsletter" name="newsletter" width="238" height="63" border="0" id="newsletter" /></a>
<!--<a href="http://www.helpthehospices.org.uk/media-centre/press-releases/hospice-care-and-the-liverpool-care-pathway/ "><img src="images/helphospices.jpg" alt="Hospice Care & Liverpool Care Pathway" /></a>-->
<!--<a href="http://www.dyingmatters.org" target="_blank"><img src="images/dying_matters.jpg" alt="Dying Matters Awareness week" border="0" /></a>-->
</div>
</div>
<!--end of sidebar-->
<div class="clear"></div>
<!-- InstanceEndEditable -->

</div><!--end of content-->
<div id="footer">
<div id="left_footer">&copy; 2012 St Giles Hospice<br />
<a href="terms-conditions.html">Terms of use</a> | <a href="privacy-policy.html">Privacy Policy</a></div>
<div id="right_footer">St Giles Hospice, Fisherwick Road, Whittington, Lichfield, WS14 9LH<br />
Tel: 01543 432 031<br />
Fax: 01543 433 346<br />
Email: <a href="mailto:enquiries@st-giles-hospice.org.uk">enquiries@st-giles-hospice.org.uk</a></div>
<div id="paypal">
<a href="http://www.justgiving.com/stgileshospice/donate" target="_blank"><img src="eflyer/images/donate_button.gif" alt="Donation Online button" width="125" height="80" border="0"/></a>
</div>
<div id="twitter"><a href="http://www.twitter.com/stgileshospice" target="_blank"><img src="images/transparent.gif" alt="follow us on twitter" name="twitterlink" width="41" height="41" border="0" id="twitterlink" class="twitterlink" onmouseover="MM_swapImage('twitterlink','','images/twitter_hover.gif',1)" onmouseout="MM_swapImgRestore()" /></a><a href="http://www.facebook.com/home.php?#!/pages/St-Giles-Hospice/27847003845?ref=ts" target="_blank"><img src="images/transparent.gif" alt="follow us on facebook" name="facebooklink" width="41" height="41" border="0" id="facebooklink" onmouseover="MM_swapImage('facebooklink','','images/facebook_hover.gif',1)" onmouseout="MM_swapImgRestore()"  /></a></div>
</div><!--end of footer-->
</div><!--end of wrapper-->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6461403-13");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
<!-- InstanceEnd --></html>
