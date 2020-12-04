<html>
	<head>
	<style>
		#holder{
		  background: #eee;
		  padding: 32px 0 16px 0;
		}
		.canvas-wrapper{
		  margin-bottom: 16px;
		}
		canvas{
		  margin: 0 auto;
		  display: block;
		}
	</style>
	</head>
	<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.385/build/pdf.min.js"></script>
	
	<body>
		<div id="holder"></div>
	</body>
</html>
<script>
function renderPDF(url, canvasContainer, options) {

    options = options || { scale: 1 };
        
    function renderPage(page) {
        var viewport = page.getViewport(options.scale);
        var wrapper = document.createElement("div");
        wrapper.className = "canvas-wrapper";
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var renderContext = {
          canvasContext: ctx,
          viewport: viewport
        };
        
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        wrapper.appendChild(canvas)
        canvasContainer.appendChild(wrapper);
        
        page.render(renderContext);
    }
    
    function renderPages(pdfDoc) {
        for(var num = 1; num <= pdfDoc.numPages; num++)
            pdfDoc.getPage(num).then(renderPage);
    }

    PDFJS.disableWorker = true;
    PDFJS.getDocument(url).then(renderPages);

}   


renderPDF('compressed.tracemonkey-pldi-09.pdf', document.getElementById('holder'));
</script>


