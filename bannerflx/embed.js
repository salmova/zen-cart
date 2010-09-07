/* 
Created by 12leaves.com
@copyright Copyright 2009-2010 12leaves.com

To change the BANNER SIZE you should change 953 and 256 (width and height in px) parameters of swfobject.embedSWF(...) function.
*/
var flashvars = {};
flashvars.url = "bannerflx/settings.xml";
var params = {};
params.wmode = "opaque";
params.bgcolor = "#fafbef";
params.quality = "high";

swfobject.embedSWF("bannerflx/bannerflx.swf", "bannerflx", "953", "256", "8.0.0", false, flashvars, params);

