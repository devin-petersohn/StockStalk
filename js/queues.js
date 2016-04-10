
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
                    $("#addTableRow").append("<tr><td><input type='checkbox' class='chartstock' name='chartStock' value='"+tickername+"'> "+ tickername + "<div id='hideMe'><div class='deleteMe'><button><img src='img/trashcan.png'></button></div></div></input></td></tr></div>");
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


function toggle_visibility(id) 
{
    /*var e = document.getElementById(id);
    if (e.style.display == 'block' || e.style.display=='')
    {
        e.style.display = 'none';
    }
    else 
    {
        e.style.display = 'block';
    }
    */
    $("#hideMe").toggle();
    
    
    
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
$(".deleteMe").on("click", function(){
   $(this).closest("li").remove(); 
});
