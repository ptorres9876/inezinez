/*canvas html5*/
var canvas;
var context;

/*objeto para animar*/
var porcupine;

/*configuracion de ancho y largo*/
var width;
var height;

/*imagenes*/
var image;
var image2;

/*valores de configuracion*/
var speed =0.02;
var t = 0;
var index = 0;
var p0 = {x:0, y:0};
var p1 = {x:0, y:0};
var p2 = {x:0, y:0};
var p3 = {x:0, y:0};
var last = {x:0, y:0};
var last2 = {x:0, y:0};
var flag = true;
var f = false;

/*parametros extra*/
var deltaX;
var cero;
var low;
var medium;
var high;     

              
$(document).ready(function(){
    
    //puercoespin
    porcupine = {
        x: 0,
        y: 0,
        width: 0,
        height: 0,
        t : 0
      };
    
    //callback
    window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
        function(callback) {
            window.setTimeout(callback, 100 / 60);
        };
    })();
    
    canvas = document.getElementById('myCanvas');
    context = canvas.getContext('2d');
    context.canvas.width  = window.innerWidth;
    context.canvas.height = window.innerHeight * 0.15;	

    //porcentaje del ancho total de la pantalla
    width = context.canvas.width * 0.8;
    
    //porcentaje de altura maxima de salto
    height = context.canvas.height *0.3;
    
    //offsets para las huellas
    porcupine.height = height * 0.9;
    porcupine.width = width / 20;
    
    //alturas de los brincos
    cero = height / 4;
    low = 5*height / 12;
    medium = 7*height / 12;
    high = 3*height/4;
         
    image = new Image();
    image2 = new Image();
    
    index = 0;     
    deltaX = width / 10;
     
    image.src = 'resources/img/puerco.png';
    image2.src = 'resources/img/huellitas.png';
    
    drawPorcupine(porcupine, context);
	
    //frames
    setTimeout(function() {
        var startTime = (new Date()).getTime();
        animate(porcupine, canvas, context, startTime);
    }, 1000);
    
});


function drawPorcupine(porcupine, context, op)
{
    context.globalAlpha = 1.0;
    context.drawImage(image, porcupine.x, porcupine.y);
    context.drawImage(image2, last.x + porcupine.width, last.y + porcupine.height);
    context.globalAlpha = op;
    context.drawImage(image2, last2.x + porcupine.width, last2.y + porcupine.height);
    context.stroke();
}

function animate(porcupine, canvas, context, startTime)
{
          
    var time = (new Date()).getTime() - startTime;
    
    //discretizacion del movimiento & offset de umbral
    if(porcupine.x >= deltaX*(index+1) - 4.0)
    {
        index++;
        flag = true;
        porcupine.t = 0;   
    }
           
    if(flag)
    {
        
        var h1;
        var h2;
        
        //siguiente altura
        switch(index)
        {
            case 0:
                    h1 = cero;
                    h2 = low;
                    break;
            case 1:
                    h1 = low;
                    h2 = medium;
                    break;
            case 2:
                    h1 = medium;
                    h2 = high;
                    break;
            case 3:
                    h1 = high;
                    h2 = medium;
                    break;
            case 4:
                    h1 = medium;
                    h2 = low;
                    break;
            case 5:
                    h1 = low;
                    h2 = cero;
                    break;
            case 6:
                    h1 = cero;
                    h2 = low;
                    break;
            case 7:
                    h1 = low;
                    h2 = medium;
                    break;
            case 8:
                    h1 = medium;
                    h2 = high;
                    break;
            case 9:
                    h1 = high;
                    h2 = medium;
                    break;
            default:
                    return;
        }
        
    
            p0.x = deltaX*index;
            p0.y = h1;

            p1.x = deltaX*(0.33 + index);
            p1.y = -h2/3;

            p2.x = deltaX*(0.66 + index);
            p2.y = -2*h2/3;

            p3.x = deltaX*(1+index);
            p3.y = h2;

            last2.x = last.x;
            last.x = p0.x;

            last2.y = last.y;
            last.y = p0.y;
        
        
               
        flag = false;
               
    }
           
           
    //valores de la curva de movimiento       
    t = porcupine.t;
           
    var cx = 3 * (p1.x - p0.x)
    var bx = 3 * (p2.x - p1.x) - cx;
    var ax = p3.x - p0.x - cx - bx;
    
    var cy = 3 * (p1.y - p0.y);
    var by = 3 * (p2.y - p1.y) - cy;
    var ay = p3.y - p0.y - cy - by;
   
    var xt = ax*(t*t*t) + bx*(t*t) + cx*t + p0.x;
    var yt = ay*(t*t*t) + by*(t*t) + cy*t + p0.y;
    
    porcupine.t += speed;
    
    if (porcupine.t > 1) {
        porcupine.t = 1;
    }
    
    
    porcupine.x=xt;
    porcupine.y=yt;

    
    //limpiar contexto
    context.clearRect(0, 0, canvas.width, canvas.height);
    
    //dibujar
    drawPorcupine(porcupine, context, 1-t);
        
    //nuevo frame
    requestAnimFrame(function() {
        animate(porcupine, canvas, context, startTime);
    }); 

}