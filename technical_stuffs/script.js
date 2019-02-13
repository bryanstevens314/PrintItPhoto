
function myFunction(array) {

    var id = array['charge_ID'];

        $.ajax({
        url: 'stripeStuff.php',
        dataType: 'json',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify( { "charge_ID": id} ),
         success:function(data) {
        console.log("success:"+data); 
         },
        error:function(data) {
        console.log("Error:"+JSON.stringify(data)); 
         }
    });
    
    

}

function GetWidthOfDiv(currentDiv) {
    var width = document.getElementById(currentDiv).offsetWidth;
    return width;
}

function Minimizeclicked(){

       var chartHeight = document.getElementById('p1').clientHeight;
       console.log(document.getElementById('wrapper').clientWidth);
       console.log(document.getElementById('wrapper').clientHeight);
       var stop = "NO";
    if ( document.getElementById('wrapper').clientHeight == 65){
        console.log ("minimize clicked");
          document.getElementById('p1').style.height = '300px'; 
          document.getElementById('c1').style.height = '260px';
          document.getElementById('wrapper').style.height = '355px';
          
          document.getElementById('Day').style.opacity = 1;
          document.getElementById('Week').style.opacity = 1;
          document.getElementById('Month').style.opacity = 1;
          document.getElementById('Year').style.opacity = 1;
          stop = "YES";
    }
        if ( document.getElementById('wrapper').clientHeight == 355){
          if (stop == "NO"){
                        console.log ("minimize clicked");

       document.getElementById('p1').style.height = '65px'; 
       document.getElementById('c1').style.height = '0px';
       document.getElementById('wrapper').style.height = '65px';
       
       document.getElementById('Day').style.opacity = 0;
       document.getElementById('Week').style.opacity = 0;
       document.getElementById('Month').style.opacity = 0;
       document.getElementById('Year').style.opacity = 0;
          }

    }
    return true;
}


function shippingClickedCheck(array){

// window.localStorage.setItem("checkedID", array['ID']);
// window.localStorage.setItem("checked", "check");
console.log ("shipping clicked");
	var id = array['ID'];
	var check = "check";
    $.ajax({
        url: 'shippingChecked.php',
        dataType: 'json',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify( { "id": id, "status": check } ),
         success:function(data) {
        console.log("success:"+data); 
         },
        error:function(data) {
        console.log("Error:"+data); 
         }
    });
    
}

function shippingClickedUncheck(array){
	var id = array['ID'];
	var check = "uncheck";
    $.ajax({
        url: 'shippingChecked.php',
        dataType: 'json',
    type: 'POST',
    contentType: 'application/json',
    data: JSON.stringify( { "id": id, "status": check } ),
         success:function(data) {
        console.log("success:"+data); 
         },
        error:function(data) {
        console.log("Error:"+data); 
         }
    });
}

function SignUpClicked(){
}


function DisplayDailyUsers(){
window.localStorage.setItem("CurrentDataView", "Daily");

}


function DisplayWeeklyUsers(){


window.localStorage.setItem("CurrentDataView", "Weekly");
}

function DisplayMonthlyUsers(){
window.localStorage.setItem("CurrentDataView", "Monthly");
}

function DisplayYearlyUsers(){
window.localStorage.setItem("CurrentDataView", "Yearly");
}




