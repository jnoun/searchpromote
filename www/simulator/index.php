<?php

$aURLs = array
(
	'pcw' 		=> array
	(
		'dev' 	=> array
		(
			'stage' => 'http://stage.pc_world_dev.guided.lon5.atomz.com',
			'live'  => 'http://pc_world_dev.guided.lon5.atomz.com'
		),
		'test01'	=> array
		(
			'stage' => 'http://stage.sp1004e23c.guided.lon5.atomz.com',
			'live'  => 'http://sp1004e23c.guided.lon5.atomz.com'
		),
		'test02'	=> array
		(
			'stage' => 'http://stage.sp1004e23d.guided.lon5.atomz.com',
			'live'  => 'http://sp1004e23d.guided.lon5.atomz.com'
		),
		'prod'	=> array
		(
			'stage' => 'http://stage.pc_world.guided.lon5.atomz.com',
			'live'  => 'http://pc_world.guided.lon5.atomz.com'
		)
	),
	'currys'	=> array
	(
		'dev' 	=> array
		(
			'stage' => 'http://stage.currys_dev.guided.lon5.atomz.com',
			'live'  => 'http://currys_dev.guided.lon5.atomz.com'
		),
		'test01'	=> array
		(
			'stage' => 'http://stage.sp1004e23e.guided.lon5.atomz.com',
			'live'  => 'http://sp1004e23e.guided.lon5.atomz.com'
		),
		'test02'	=> array
		(
			'stage' => 'http://stage.sp1004e23f.guided.lon5.atomz.com',
			'live'  => 'http://sp1004e23f.guided.lon5.atomz.com'
		),
		'prod'	=> array
		(
			'stage' => 'http://stage.currys.guided.lon5.atomz.com',
			'live'  => 'http://currys.guided.lon5.atomz.com'
		)
	)
);

$sQueryString = '?i=1&sp_cs=UTF-8&do=json';

$sCurrentSite = (true === isset($_GET['site'])) ? $_GET['site'] : 'currys';
$sCurrentPlatform = (true === isset($_GET['platform'])) ? $_GET['platform'] : 'dev';
$sCurrentIndex = (true === isset($_GET['index'])) ? $_GET['index'] : 'stage';

$sCurrentFeedHost = $aURLs[$sCurrentSite][$sCurrentPlatform][$sCurrentIndex];

?>

<html>
<head>
<style type="text/css">
.toggle-box {
  display: none;
}

.toggle-box + label {
  display: block;
}

.toggle-box + label + ul {
  display: none;
}

.toggle-box:checked + label + ul {
  display: block;
}
a
{
	color:black;
}
a.selected
{
	color:red;font-weight:bold;
}

</style>
</head>
<div class="yui-skin-sam">
<form name="searchform" method="GET" action="">
	<input type="text" id="q" name="search"/>
	<input type="submit" value="go" />
	<input type="hidden" name="site" value="<?php echo $sCurrentSite; ?>" />
	<input type="hidden" name="platform" value="<?php echo $sCurrentPlatform; ?>" />
	<input type="hidden" name="index" value="<?php echo $sCurrentIndex; ?>" />

<div id="autocomplete" style="background-color:lime"></div>
<input type="hidden" name="sp_cs" value="UTF-8" />
</form>
<div style="float:right">
<ul>
<?php

foreach($aURLs as $sSite => $aPlatforms)
{
	foreach($aPlatforms as $sPlatform => $aIndexes)
	{
		echo '<li><b>' . ucfirst($sSite) . ' ' . ucfirst($sPlatform) . ':</b>&nbsp;';

		foreach($aIndexes as $sIndex => $sHost)
		{
			if ($sSite === $sCurrentSite && $sPlatform === $sCurrentPlatform && $sIndex === $sCurrentIndex)
			{
				$bSelected = true;
			}
			else
			{
				$bSelected = false;
			}

			$sUrl = $_SERVER['SCRIPT_URI'] . '?site=' . $sSite . '&platform=' . $sPlatform . '&index=' . $sIndex;
			echo '<a href="' . $sUrl . '"' . (($bSelected === true) ? ' class="selected"' : ''). '>' . $sIndex .'</a>&nbsp;';
		}
		echo '</li>';
	}
}

?>
</ul>
</div>

<!-- <b>Currys Dev : </b><a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=currys&platform=dev&index=live">live</a>
/
<a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=currys&platform=dev&index=stage">stage</a>
&nbsp;<b>Currys Prod:</b> 
<a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=currys&platform=prod&index=live">live</a>
/
<a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=currys&pltaform=prod&index=stage">stage</a>
<div style="float:right">
<b>Pcw Dev :</b>
<a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=pcw&platform=dev&index=live">live</a>
/
<a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=pcw&platform=dev&index=stage">stage</a>
&nbsp;<b>Pcw Prod :</b>
<a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=pcw&platform=prod&index=live">live</a>
/
<a href="http://pulvaj01.sp_simulator.fo.dev.hml.dixonsretail.net/?site=pcw&pltaform=prod&index=stage">stage</a>
</div>-->
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/utilities/utilities.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/yui/2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript" src="//content.lon5.atomz.com/sp1004e1d7/publish/autocomplete_data.js?sp_js_cache_ver=1"></script>
<?php

$rFile = fopen('/home/pulvaj01/attlist.csv', 'r');
while (false === feof($rFile))
{
	$aValues = fgetcsv($rFile);
	$aAttList[$aValues[0]] = $aValues[3]; 
	$aAttList[$aValues[1]] = $aValues[2]; 
}

fclose($rFile);

function getTranslation($sValue)
{
	if (false !== strpos(strtoupper($sValue), 'BV'))
	{
		if (true == isset($GLOBALS['aAttList'][strtoupper($sValue)]))
		{
			return isset($GLOBALS['aAttList'][strtoupper($sValue)]) ? $GLOBALS['aAttList'][strtoupper($sValue)] : $sValue;
		}
	}

	return $sValue;
}

function getLinkUrl($sLink)
{
	return $_SERVER['SCRIPT_URI'] . '?site=' . $GLOBALS['sCurrentSite'] . '&index=' .  $GLOBALS['sCurrentIndex'] . '&platform=' . $GLOBALS['sCurrentPlatform'] .  '&link=' . urlencode($sLink);
}


/*if (false === isset($_GET['viewall']))
{
	if (true == isset($_GET['results_per_page']))
	{
		$iResultsByPage = (int) $_GET['results_per_page'];
	}
	else
		$iResultsByPage = 20;

	$sAdobeUrl .= '&m_results_per_page=' .  $iResultsByPage; 
}*/

if (true === isset($_GET['link'])){
	$sAdobeUrl = $sCurrentFeedHost . $_GET['link'];
}
else
{
	$sAdobeUrl = $sCurrentFeedHost . $sQueryString . '&q=' . (true === isset($_GET['search']) ? urlencode($_GET['search']) : '*');
}

$ch = curl_init();

// Configuration de l'URL et d'autres options

var_dump($sAdobeUrl);

curl_setopt($ch, CURLOPT_URL, $sAdobeUrl);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Récupération de l'URL et affichage sur le naviguateur
$sJsonResult = curl_exec($ch);

//get Mobile template Result
curl_setopt($ch, CURLOPT_URL, str_replace('json', 'mobile', $sAdobeUrl));

$sMobileJsonResult = curl_exec($ch);

// Fermeture de la session cURL
curl_close($ch);

//echo $sJsonResult;
$aResult 	= json_decode($sJsonResult);
$aMobileResult 	= json_decode($sMobileJsonResult) ;
?>


<div id="facets" style="border:1px solid black;float:left;width=30%">
<div id="selected-criteria" style="border:1px solid black">
<?php
echo "<p>Selected criteria :</p><ul>";
foreach($aResult->breadcrumbs[1]->values as $sKey => $oValue)
{
	echo '<li>' . getTranslation($oValue->value) . ' <a href="' .getLinkUrl($oValue->droppath) .  '">X</a></li>';
}
echo '</ul>
</div>
';

foreach( $aResult->facets as $sKey => $oFacet)
{
	if(true === isset($oFacet->label))
	{
		echo '<input class="toggle-box" id="identifier-' . $sKey . '" type="checkbox" >';	
		echo '<label for="identifier-' . $sKey . '">' . $oFacet->label . ': </label>';
		echo '<ul>';
		foreach ($oFacet->values as $sKey => $oValue)
		{
			echo '<li><a href="' . getLinkUrl($oValue->link) . '">' . getTranslation($oValue->value) .'(' . $oValue->count .  ')</a></li>';
		}
		echo '</ul>';
	}
}

?>

</div>
<div id="results" style="border:1px solid black;float:right;width:70%">
<?php

$sQuerySearched = true === isset($_GET['search']) ? $_GET['search'] : $aResult->general->query;

//var_dump($aResult);
 $iResultsByPage = ceil($aResult->general->total /  $aResult->general->page_total);
echo "Query searched : "  . $sQuerySearched . " / Query executed : " . $aResult->general->query ." </p>";
echo "<p>Results: " . $aResult->general->total . '</p>';
echo "<p>Results by page: ";

foreach($aResult->menus[1]->items as $sKey => $oItem)
{
 echo '<a href="' .  getLinkUrl($oItem->path) .'"' . ($oItem->selected == 'true' ? 'class="selected"':'')  . '>' . $oItem->value . '</a>&nbsp;';
}

echo 'Sort by : ';
foreach($aResult->menus[0]->items as $sKey => $oItem)
{
 echo '<a href="' .  getLinkUrl($oItem->path) .'"' . ($oItem->selected == 'true' ? 'class="selected"':'')  . '>' . $oItem->label. '</a>&nbsp;';
}

 echo '</p>';
echo "<p>Pages: " . $aResult->general->page_total . '</p>';

if (true === isset($aResult->suggestions))
{
  echo '<p>Did you mean ? : </p><ul>';

 foreach($aResult->suggestions as $sKey => $oSuggestion)
 {
    echo '<li><a href="' . getLinkUrl($oSuggestion->path) .  '">' . $oSuggestion->suggestion . '</a></li>';
 }

 echo '</ul>';

}	

#var_dump($aResult);

echo '<p> Results : </p><ol>';


$sPagination = '';
if  ($aResult->general->page_total > 1)
{
	foreach($aResult->pagination[1]->pages as $sKey => $oPage)
	{
		if($oPage->page == 1)
		{
			$sPagination .= '<a href="' . getLinkUrl($oPage->link) . '"><<<</a>&nbsp;';
		}

		if($oPage->selected === 'true')
		{
			$sPagination .= '<b>';
		}

		$sPagination .= '<a href="' . getLinkUrl($oPage->link) .'"' . ($oPage->selected == 'true' ? 'class="selected"':'')  . '>' . $oPage->page . '</a>';

		if($oPage->selected === 'true')
		 {
			$sPagination .= '</b>';
		 }

		$sPagination .= '&nbsp;';
	}
	$sPagination .= '&nbsp;<a href="' . getLinkUrl($aResult->pagination[1]->last) . '">>></a>';

	echo '<p> Pages : ';
	echo $sPagination;

	$iCurrentPage = $aResult->pagination[1]->current; 
}
else
{
	$iCurrentPage = 1;	
}

 foreach($aMobileResult->resultsets->default->results  as $sKey => $oResult)
 {
	$iRealNumber = ($sKey + 1) + ($iCurrentPage - 1) * $iResultsByPage ;
	$sImageUrl = 'http://brain-images.cdn.dixons.com/' . $oResult->id[7] . '/' . $oResult->id[6] . '/' . $oResult->id . '/t_' .  $oResult->id . '.jpg';
echo '<li value="' . $iRealNumber . '">' . '<a href="http://www.currys.co.uk/gbuk/dummy/dummy/dummy/dummy-' . $oResult->id . '-pdt.html"><img src="' . $sImageUrl . '"/>' . $oResult->brand . ' : ' .  $oResult->title . '</a><div style="padding-top:60px;float:right;font-weight:bold">&pound;' . $oResult->price . '</div></li>';
	
 }

echo '</ol>';

if  ($aResult->general->page_total > 1)
{
	echo '<p> Pages : ';
	echo  $sPagination;
}


echo '<p><a href="' . $sAdobeUrl  . '" target="_blank">Raw Feed output</a></p>';

?>
</div>
</html>
