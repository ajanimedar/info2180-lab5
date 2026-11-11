document.addEventListener("DOMContentLoaded", function(){

    const lookupBtn = document.getElementById("lookup");
    const lookupCitiesBtn = document.getElementById("lookupcities");
    const resultDiv = document.getElementById("result");
    const countryInput = document.getElementById("country");

    function getData(isCityLookup) {
        const country = countryInput.value;
        let url = "world.php?country=" + encodeURIComponent(country);
    
    

    if (isCityLookup=== true){
        url = url + "&lookup=cities";
    }

    const request = new XMLHttpRequest();

    request.onreadystatechange= function(){
        if (request.readyState === XMLHttpRequest.DONE){
            if(request.status === 200){
                resultDiv.innerHTML = request.responseText;
            }else{
                resultDiv.innerHTML = "There was a problem with the request.";

            }
            
        }
    };

    request.open("GET", url, true);
    request.send();  
}

lookupBtn.addEventListener("click", function() {
    getData(false);
});

lookupCitiesBtn.addEventListener("click", function() {
    getData(true);
});




});