function blackOut(div) {
    var className = div.getAttribute("class");
    if (className == "black") {
        div.className = "white";
    } else {
        div.className = "black";
    }
}

function highLight(div) {
    var className = div.getAttribute("class");
    if (className == "black") {
        div.className = "white";
        grabIt();
    } else {
        div.className = "black";
        grabIt();
    }
}

function grabIt() {
    var theDiv = document.getElementById('origin');
    var chosenWords = theDiv.getElementsByClassName('button');
    var chosenLength = chosenWords.length;
    var i = 0;
    var thePoem = [];
    var theString ='';
    while (i < chosenLength) {
    	 var plainText = chosenWords.item(i).innerHTML;
    	 thePoem.push(plainText);      	
    	 theString = theString + ' ' + plainText;    	 		
    	i++;
    };    
    var theTitle = theString.substring(0,28) + ' . . . ';
         console.log(theString);
         console.log('the title -' + theTitle);
    var theBody = document.getElementById('origin').innerHTML;     


    document.getElementById('input_1_1').value = theTitle;
    document.getElementById('input_1_2').value = theBody;      
}


jQuery('#save_image_locally').click(function() {
    html2canvas(jQuery('#origin' || '#blackened'), {
        onrendered: function(canvas) {
            var a = document.createElement('a');
            // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
            a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
            a.download = 'erasurePoem.jpg';
            a.click();
        },
        background: '#fff',
    });
});


