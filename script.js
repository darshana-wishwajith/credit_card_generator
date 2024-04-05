let mkBtn = document.getElementById("mkBtn");
let shBtn = document.getElementById("shBtn");

let makeWindow = document.getElementById("make");
let searchWindow = document.getElementById("search");

mkBtn.onclick = function(){

    this.style.textDecoration = "underline";
    this.style.textUnderlineOffset = "5px";
    this.style.fontWeight = "bold";
    this.style.transition = "0.5s";

    shBtn.style.textDecoration = "none";
    shBtn.style.fontWeight = "normal";
    shBtn.style.transition = "0.5s";

    makeWindow.classList.toggle("d-none");
    searchWindow.classList.toggle("d-none");

    searchWindow.style.transition = "0.5";
    makeWindow.style.transition = "0.5";
}

shBtn.onclick = function(){

    this.style.textDecoration = "underline";
    this.style.textUnderlineOffset = "5px";
    this.style.fontWeight = "bold";
    this.style.transition = "0.5s";

    mkBtn.style.textDecoration = "none";
    mkBtn.style.fontWeight = "normal";
    mkBtn.style.transition = "0.5s";

    this.style.textDecoration = "underline";
    makeWindow.classList.toggle("d-none");
    searchWindow.classList.toggle("d-none");

    makeWindow.style.transition = "0.5";
    searchWindow.style.transition = "0.5";
}

let clearBtn = document.getElementById("clearBtn");

clearBtn.onclick = function(){
    
    document.getElementById("cardType").value = "0";
    document.getElementById("cardNetwork").value = "0";
    document.getElementById("hName").value = "";
    document.getElementById("cvv").value = "";
    document.getElementById("exDate").value = "";
    document.getElementById("pw").value = "";
}

let generateBtn = document.getElementById("generateBtn");

generateBtn.onclick = function(){

    let cardType = document.getElementById("cardType");
    let cardNetwork = document.getElementById("cardNetwork");
    let hName = document.getElementById("hName");
    let cvv = document.getElementById("cvv");
    let exDate = document.getElementById("exDate");
    let password = document.getElementById("pw");

    let form = new FormData();

    form.append("cardType",cardType.value);
    form.append("cardNetwork",cardNetwork.value);
    form.append("hName",hName.value);
    form.append("cvv",cvv.value);
    form.append("exDate",exDate.value);
    form.append("password",password.value);

    let request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let response = request.responseText;

            if(response == "1"){
                swal("Error", "Please select a card type", "error");
            }
            else if(response == "2"){
                swal("Error", "Invalid card type", "error");
            }
            else if(response == "3"){
                swal("Error", "Please select a card network", "error");
            }
            else if(response == "4"){
                swal("Error", "Invalid card network", "error");
            }
            else if(response == "5"){
                swal("Error", "Please enter your name with initials", "error");
            }
            else if(response == "6"){
                swal("Error", "Holder's name is too short", "error");
            }
            else if(response == "7"){
                swal("Error", "Invalid CVV number", "error");
            }
            else if(response == "8"){
                swal("Error", "Something went wrong in expire date", "error");
            }
            else if(response == "9"){
                swal("Error", "plase select an expire date", "error");
            }
            else if(response == "10"){
                swal("Error", "Please enter a password for your card", "error");
            }
            else if(response == "11"){
                swal("Error", "Your password is too short", "error");
            }
            else if(response == "12"){
                swal("Error", "Somthing went wrong! please try again", "error");
            }
            else{

                let jsonObj = JSON.parse(response);

                let cardType = jsonObj.type_name;
                let cardNo = jsonObj.card_no;
                let exDate = jsonObj.exipre_date;
                let holderName = jsonObj.holder_name;
                let cardNetwork = jsonObj.network_name;
                let cvv_num = jsonObj.cvv;

                document.getElementById("ct").textContent = cardType;

                for(let i = 0; i < cardNo.length; i += 4){
                    document.getElementById("cn_group_"+i).textContent = cardNo.substring(i, i+4);
                }

                let exd = new Date(exDate);

                let month = exd.getMonth();
                let year = exd.getFullYear();

                if(parseInt(month) < 10){
                    month = parseInt(month) + 1;
                    month = month.toString();
                    month = "0"+month;
                }

                year = year.toString().substring(2,4);

                document.getElementById("month").textContent = month;
                document.getElementById("year").textContent = year;

                document.getElementById("holder").textContent = holderName;

                if(cardNetwork == 'Visa'){
                    document.getElementById("network_logo").src="images/visa.png";
                    document.getElementById("network_logo2").src="images/visa.png";
                }
                else{
                    document.getElementById("network_logo").src="images/master_logo_2.png";
                    document.getElementById("network_logo2").src="images/master_logo_2.png";
                }
                
                document.getElementById("cvv_num").textContent = cvv_num;

                swal("Your Card is ready to use","Card generation completed successfully!","success");

            }
        }
    }

    request.open("POST", "cardGenerationProcess.php", true);
    request.send(form);
}

let searchBtn = document.getElementById("searchBtn");

searchBtn.onclick = function(){

    let hName2 = document.getElementById("hName2");
    let password2 = document.getElementById("pw2");

    let form2 = new FormData();

    form2.append("hName2",hName2.value);
    form2.append("password2",password2.value);

    let request2 = new XMLHttpRequest();

    request2.onreadystatechange = function(){
        if(request2.readyState == 4 && request2.status == 200){
            let response2 = request2.responseText;

            if(response2 == "1"){
                swal("Error", "Please enter your name with initials", "error");
            }
            else if(response2 == "2"){
                swal("Error", "Please enter a password for your card", "error");
            }
            else if(response2 == "3"){
                swal("Error", "Your card not found!", "error");
            }
            else{

                let jsonObj2 = JSON.parse(response2);

                let cardType = jsonObj2.type_name;
                let cardNo = jsonObj2.card_no;
                let exDate = jsonObj2.exipre_date;
                let holderName = jsonObj2.holder_name;
                let cardNetwork = jsonObj2.network_name;
                let cvv_num = jsonObj2.cvv;

                document.getElementById("ct").textContent = cardType;

                for(let i = 0; i < cardNo.length; i += 4){
                    document.getElementById("cn_group_"+i).textContent = cardNo.substring(i, i+4);
                }

                let exd = new Date(exDate);

                let month = exd.getMonth();
                let year = exd.getFullYear();

                if(parseInt(month) < 10){
                    month = parseInt(month) + 1;
                    month = month.toString();
                    month = "0"+month;
                }

                year = year.toString().substring(2,4);

                document.getElementById("month").textContent = month;
                document.getElementById("year").textContent = year;

                document.getElementById("holder").textContent = holderName;

                if(cardNetwork == 'Visa'){
                    document.getElementById("network_logo").src="images/visa.png";
                    document.getElementById("network_logo2").src="images/visa.png";
                }
                else{
                    document.getElementById("network_logo").src="images/master_logo_2.png";
                    document.getElementById("network_logo2").src="images/master_logo_2.png";
                }
                
                document.getElementById("cvv_num").textContent = cvv_num;

                swal("A card with your details was found", "Your Card is ready to use", "success");
            }
        }
    }

    request2.open("POST", "cardSearchProcess.php", true);
    request2.send(form2);
    
}