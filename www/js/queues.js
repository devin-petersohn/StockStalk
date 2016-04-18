var array = [];
var i;
function addToQueue(name){
    var same = 0;
    console.log(name.innerHTML);
    var tickername = name.innerHTML;
    for(i = 0; i < array.length; i ++){            
        if(tickername == array[i]){
            same = 1
        }
    }
    if(same == 0){
//                    $("#addTableRow").append("<tr><td><input type='checkbox' class='chartstock' name='chartStock' value='"+tickername+"'> "+ tickername + "<div id='hideMe'><div class='deleteMe'><button><img src='img/trashcan.png'></button></div></div></input></td></tr></div>");
        $("#addTableRow").append("<tr><td><input type='checkbox' class='chartstock' name='chartStock' value='"+tickername+"'> "+ tickername + "<button style='margin-left:8px;border:0px;' type='button' class='small-btn hideMe' onclick='deleteRow(this)'><img src='img/trashcan.png' style='display:none'></button></td></tr>");
        array.push(tickername);
    }

//                var appendString = "<tr><td><input type='checkbox' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>";
//                console.log(appendString);

}



//Function for adding to Navbar My Stocks//
var arrayMS = [];
var m;

function addToQueueMS(name){
    var same = 0;
    console.log(name.innerHTML);
    var tickername = name.innerHTML;
    for(m = 0; m < arrayMS.length; m ++){            
        if(tickername == arrayMS[m]){
            same = 1
        }
    }
    if(same == 0){
        $("#addTableRowMS").append("<tr><td><input type='checkbox' class='chartstock' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>");
        arrayMS.push(tickername);
        console.log(name.innerHTML);
    }
//                var appendString = "<tr><td><input type='checkbox' name='chartStock' value='"+tickername+"'> "+ tickername +"</input></td></tr>";
//                console.log(appendString);

}



//Toggle Show/Hide Delete Button


function toggle_visibility() 
{
//    var e = document.getElementsByClassName("hideMe");
//    console.log(e[0].firstChild);
//    
//       
//    if (e[0].firstChild.style.display == 'block' || e[0].firstChild.style.display=='')
//    {
//        e[0].firstChild.style.display = 'none';
//    }
//    else 
//    {
//        e[0].firstChild.style.display = 'block';
//    }
    $('.hideMe').each(function(i) {
        var element = document.getElementsByClassName("hideMe");
        var img = element[i].firstChild;
        if (img.style.display =='none'){
            img.style.display = 'block';
            return;
        }
        img.style.display ='none';
        });
}


/*
function toggle(){
    
        $('img').each(function(i) {
            var div = document.getElementById("divSection");
                   if (div.style.display =='none'){
                       div.style.display = 'block';
                       return;
                   }
                   div.style.display ='none';
             });
        }
                   
*/

//Delete function
//$(".deleteMe").on("click", function(){
//   $(this).closest("li").remove(); 
//});



//Delete function to delete queued stock table row and also delete the element in queue array.
function deleteRow(btn){
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    var name = btn.parentElement.firstChild.value;
    position = array.indexOf(name);
    if(~position){
        array.splice(position,1);
    }
}


