// JavaScript Document
$(function(){
	function x2(n,i,x1,r) {return x1 + r*Math.sin(2*Math.PI*n/i);};
	function y2(n,i,y1,r) {return y1 - r*Math.cos(2*Math.PI*n/i);};        
          
	function mostrar_hora( ) {
		var d = new Date();
		var h = d.getHours();
		var m = d.getMinutes();
		var s = d.getSeconds();
		var ms = parseInt(d.getMilliseconds()/100);
		var mls = d.getMilliseconds();
				
		//comprobamos el numero de dÃ­gitos y si tiene 1, le ponemos un cero delante
		if(h<10) h="0"+h;
		if(m<10) m="0"+m;
		if(s<10) s="0"+s;
								
		//mostramos la fecha
		$('#text').text(h + ":" + m + ":" + s + ":" + ms);
				
		//movemos las agujas del reloj
		$('#decseg').attr('x2', x2(mls,1000,80,10)).attr('y2', y2(mls,1000,110,10));
		$('#seg').attr('x2', x2(s,60,80,50)).attr('y2', y2(s,60,80,50));
		$('#min').attr('x2', x2(m,60,80,40)).attr('y2', y2(m,60,80,40));
		$('#hor').attr('x2', x2(h,12,80,30)).attr('y2', y2(h,12,80,30));
	}
    setInterval(function(){mostrar_hora();}, 1);
    mostrar_hora();
})
