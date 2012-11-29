<?php
/**
 * Example 17: Playing with axis
 */

// Standard setup
$DIR = dirname(__FILE__);
if(!defined('OUTDIR')) define('OUTDIR', $DIR);
require_once("$DIR/../lib/pChart.php");

// Dataset definition
$DataSet = new pData;
$Canvas  = new GDCanvas(700, 230);
$Chart   = new pChart(700, 230, $Canvas);

$DataSet->AddPoints(array(100, 320, 200, 10, 43), "Serie1");
$DataSet->AddPoints(array(23, 432, 43, 153, 234), "Serie2");
$DataSet->AddPoints(array(1217541600, 1217628000, 1217714400, 1217800800, 1217887200), "Serie3");
$DataSet->AddSeries("Serie1");
$DataSet->AddSeries("Serie2");
$DataSet->SetAbscissaLabelSeries("Serie3");
$DataSet->SetSeriesName("Incoming", "Serie1");
$DataSet->SetSeriesName("Outgoing", "Serie2");

$DataSet->getDataDescription()->SetYAxisName("Call duration");
$DataSet->getDataDescription()->SetYAxisFormat("time");
$DataSet->getDataDescription()->SetXAxisFormat("date");

// Initialise the graph
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 8);
$Chart->setGraphArea(85, 30, 650, 200);

$Canvas->drawFilledRoundedRectangle(new Point(7, 7), new Point(693, 223), 5, new Color(240), 1, 0, ShadowProperties::NoShadow());
$Canvas->drawRoundedRectangle(new Point(5, 5), new Point(695, 225), 5, new Color(230), 1, 0, ShadowProperties::NoShadow());

#$Test->drawGraphArea(255, 255, 255, TRUE);
$Chart->drawGraphBackground(new BackgroundStyle(new Color(255), true));
#$Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 150, 150, 150, TRUE, 0, 2);
$Chart->drawScale($DataSet, ScaleStyle::DefaultStyle(), 0, 2);
#$Test->drawGrid(4, TRUE, 230, 230, 230, 50);
$Chart->drawGrid(new GridStyle(4, TRUE, new Color(230, 230, 230), 50));

// Draw the 0 line
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 6);
$Chart->drawTreshold(0, new Color(143, 55, 72), TRUE, TRUE);

// Draw the line graph
$Chart->drawLineGraph($DataSet->GetData(), $DataSet->GetDataDescription());
$Chart->drawPlotGraph($DataSet->GetData(), $DataSet->GetDataDescription(), 3, 2, new Color(255, 255, 255));

// Finish the graph
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 8);
$Chart->drawLegend(90, 35, $DataSet->GetDataDescription(), new Color(255, 255, 255));
$Chart->setFontProperties("$DIR/../Fonts/tahoma.ttf", 10);
$Chart->drawTitle(60, 22, "Example 17", new Color(50, 50, 50), 585);
$Chart->Render(OUTDIR."/Example17.png");
