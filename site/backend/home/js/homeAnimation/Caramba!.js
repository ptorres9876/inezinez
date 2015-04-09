/*
var imageObj = new Image();
imageObj.src = 'http://www.html5canvastutorials.com/demos/assets/darth-vader.jpg';
    imageObj.width = 50px;
    imageObj.height = 50px;
      
        context.drawImage(imageObj, 0, 0);
    
*/



$(document).ready(function() {
    bezierMotion1();
});
 
function bezierMotion1(){
   
    var breadcrumbs = new Array();
    var crumbRadius=1;
    var canvas=jQuery("#bezier_motion1");
    var context = canvas.get(0).getContext("2d");
    var parentWidth=jQuery(canvas).parent().width();
    //var canvasWidth = context.canvas.width  = parentWidth;
    var canvasWidth = window.innerWidth;
    //var canvasHeight = context.canvas.height  = 288;
    var canvasHeight = window.innerHeight;
    
    //valores iniciales para la animacion
    var steps = 3;
    var dx = canvasWidth / steps;
    var dy = canvasHeight / steps;
    var x = 0;
    var y = 0;
    
    var i = 0;
    
    
        var p0 = {x: 0, y:0};
    
        var p1 = {x: 20 , y:20};
        var p2 = {x: 30, y: 20};
        var p3 = {x: 50, y: 0 };

        //function Ball(x,y,radius,color,strokeColor,lineWidth) in ball.js
        var ball_4 = new Ball(0,0,12,'#f00','#000',7);
        var speed;
        var t;
        ball_4.t=0;
        ball_4.speed=.03;
    

        if (!checkForCanvasSupport) {
            return;
        }

        (function drawFrame() {
            
        
        window.requestAnimationFrame(drawFrame, canvas);
        context.clearRect(0,0,canvasWidth,canvasHeight); // clear canvas
            
        ball_4.t=0;
        ball_4.x = 0;
        ball_4.y = 0;

        t=ball_4.t;

        var cx = 3 * (p1.x - p0.x);
        var bx = 3 * (p2.x - p1.x) - cx;
        var ax = p3.x - p0.x - cx - bx;

        var cy = 3 * (p1.y - p0.y);
        var by = 3 * (p2.y - p1.y) - cy;
        var ay = p3.y - p0.y - cy - by;

        var xt = ax*(t*t*t) + bx*(t*t) + cx*t + p0.x;
        var yt = ay*(t*t*t) + by*(t*t) + cy*t + p0.y;

        ball_4.t += ball_4.speed;
        if (ball_4.t > 1) {
        ball_4.t = 1;
        }

        ball_4.x=xt;
        ball_4.y=yt;

        ball_4.draw(context);
        
        
        }());
    
    
  
}