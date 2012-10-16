<<<<<<< HEAD

=======
window.dram = function () {
      var canvas = document.getElementById('canvas'),
          context = canvas.getContext('2d'),
          mouse = utils.captureMouse(canvas),
          points = [],
          fl = 250,
          vpX = canvas.width / 2,
          vpY = canvas.height / 2,
          angleX, angleY;

      //create 4 points
      points[0] = new Point3d(-75, -75, 75);
      points[1] = new Point3d( 75, -75, 75);
      points[2] = new Point3d( 75,  75, 75);
      points[3] = new Point3d(-75,  75, 75);
      
      points.forEach(function (point) {
        point.setVanishingPoint(vpX, vpY);
				console.log("vpX: "+ vpX);
				console.log("vpY: "+ vpY);
      });

      function move (point) {
        point.rotateX(angleX);
        point.rotateY(angleY);
      }

			var stopframe;
      function draw (point, i) {
        if (i !== 0) {
					var pX = point.getScreenX();
					var pY = point.getScreenY();
					var pwX = canvas.width - pX;
					var phY = canvas.height - pY;
          context.lineTo( pX, pY);
					if(pX > 305 && pY > 305) {
						console.log("pX: "+ pX);
						console.log("pY: "+ pY);
						window.cancelAnimationFrame(stopframe);
					} else
						if(pX > 200) {
							console.log("px: "+ pX);
							console.log("py: "+ pY);
						}

        }
      }

			var img = new Image();
			img.src = "img/have.jpg";

			var i = 0;

      (function drawFrame () {
        stopframe = window.requestAnimationFrame(drawFrame, canvas);
        context.clearRect( 0, 0, canvas.width, canvas.height);


        
        //angleX = (mouse.y - vpY) * 0.0005;
        //angleY = (mouse.x - vpX) * 0.0005;
				//console.log("X: "+ angleX);
				//console.log("Y: "+ angleY);
				angleX = 0.000;
				angleY = 0.055;
        points.forEach(move);
        context.beginPath();
        context.moveTo(points[0].getScreenX(), points[0].getScreenY());
        points.forEach(draw);
				i = img.width + i;
				context.drawImage( img, 80, 80, i++, img.height); 
        context.closePath();
        context.stroke();
      }());
};

dram();
>>>>>>> release/1.0
