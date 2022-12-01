<!-- Random Movement Script by Kurt Grigg http://website.lineone.net/~kurt.grigg/javascript

P=new Image();
P.src="pooh.gif"; //Pre-load your image here!
SY=3;             //Up-down speed!
SX=5;             //Left-right speed!
LINK="#";

//Nothing needs altering below!
n6=(document.getElementById&&!document.all);
ns=(document.layers);
ie=(document.all);
d=(ns||ie)?'document.':'document.getElementById("';
a=(ns||n6)?'':'all.';
n6r=(n6)?'")':'';
s=(ns)?'':'.style';

if (ns){
document.write("<LAYER NAME='pics' LEFT=0 TOP=0><a href="+LINK+"><img src='pooh.gif' border=0></a></LAYER>");
}
if (ie||n6){
document.write("<div id='pics' style='position:absolute;top:0px;left:0px'><a href="+LINK+"><img src="+P.src+" border=0></a></div>");
}
R=0,C1=0;PB=0,Y=0,X=0,D=0,VB=0,HB=0;
Y=10;X=10;D=Math.floor(Math.random()*60+10);
function Curve(){
plusMinus=new Array(1,-1,2,-2,3,-3,0,1,-1,4,-4)
R = plusMinus[Math.floor(Math.random()*plusMinus.length)];
}
function MoveRandom(){
C1++;
if (C1==50){Curve();C1=0}
var H=(ns||n6)?window.innerHeight:document.body.clientHeight;
var W=(ns||n6)?window.innerWidth:document.body.clientWidth;
var YS=(ns||n6)?window.pageYOffset:document.body.scrollTop;
var XS=(ns||n6)?window.pageXOffset:document.body.scrollLeft;
var BY=-P.height;
var BX=-P.width;
PB=D+=R;
y = SY*Math.sin(PB*Math.PI/180);
x = SX*Math.cos(PB*Math.PI/180);
if (D < 0) D+=360;
Y+=y;
X+=x;
VB=180-D;
HB=0-D;
//Corner rebounds! not necessary but looks nice.
if ((Y < 1) && (X < 1)) {Y=1;X=1;D=45;}
if ((Y < 1) && (X > W+BX)) {Y=1;X=W+BX;D=135;}
if ((Y > H+BY) && (X < 1)) {Y=H+BY;X=1;D=315;}
if ((Y > H+BY) && (X > W+BX)) {Y=H+BY;X=W+BX;D=225;}
//Edge rebounds!
if (Y < 1) {Y=1;D=HB;}  
if (Y > H+BY) {Y=H+BY;D=HB;}  
if (X < 1) {X=1;D=VB;} 
if (X > W+BX) {X=W+BX;D=VB;} 
var temp=eval(d+a+"pics"+n6r+s);
temp.top=Y+YS;
temp.left=X+XS;
setTimeout('MoveRandom()',10);
}
MoveRandom();
//-->

