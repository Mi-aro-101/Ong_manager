const inputs = document.querySelectorAll("input");

const patterns = {
    telephone_president: /^[0-9+\- ]{5,20}$/i,
    telephone_representant: /^[0-9+\- ]{5,20}$/i,
    mail_president: /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,4})?$/,
    mail_representant: /^([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,4})?$/
}

// Validation function
function checking(field, regex){
    if(is_date(field)){
        is_valid_date(field);
    }
    else{
        if(regex.test(field.value) && field.value == ''){
            field.className='valid';
        }
        else{
            field.className='invalid';
        }
    }
}

inputs.forEach((input) =>{
    input.addEventListener("input", (e) =>{
        checking(e.target, patterns[e.target.attributes.name.value]);
    });
});

/* if input is date then do not validate the date if user sets it for tomorrow */

function is_date(date){
    let result = false;
    if(!isNaN(Date.parse(date.value))){
        result = true;
    }
    return result;
}

function is_valid_date(date){
    let daty = new Date(date.value);
    let current_date = new Date();
    console.log(daty);
    console.log(current_date);
    if(daty >= current_date){
        date.className = "invalid";
    }
    else{
        date.className = "valid";
    }


}