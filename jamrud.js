jQuery(document).ready(function(){
  jamrud();
});
function jamrud() {
nu = new Date();
hr = nu.getHours();
min = nu.getMinutes();
sec = nu.getSeconds();

if(hr<="9"){hr = "0" + hr;} else {hr = "" + hr;}
if(min<="9"){min = "0" + min;} else {min = "" + min;}
if(sec<="9"){sec = "0" + sec;} else {sec = "" + sec;}
hrc = hr.substring(0,1);
hrd = hr.substring(1,2);
ex = "" + hrc + "" + hrd;
jQuery("#jm").html(ex);
minc = min.substring(0,1);
mind = min.substring(1,2);
x2 = "" + minc +"" + mind;
jQuery("#mn").html(x2);
secc = sec.substring(0,1);
secd = sec.substring(1,2);
z3 = "" + secc + "" + secd;
jQuery("#dk").html(z3);
setTimeout("jamrud()", 1000);
}
