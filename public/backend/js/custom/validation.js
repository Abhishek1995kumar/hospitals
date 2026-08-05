function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(email.value.trim() != '' && !regex.test(email.value)) {
        document.getElementById('emailError').style.display = "block"
    } else {
        document.getElementById('emailError').style.display = "none"
    }
}

function validateGstNumber(gst) {
    const regex = /^[0-9]{2}[aA-zZ]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[aA-zZ]{1}[0-9A-Z]{1}$/;
    if(gst.value.trim() != '' && !regex.test(gst.value)) {
        document.getElementById('gstError').style.display = "block"
    } else {
        document.getElementById('gstError').style.display = "none"
    }
}

function validatePanNumber(pan) {
    const regex = /^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/;
    if(pan.value.trim() != '' && !regex.test(pan.value)) {
        document.getElementById('panError').style.display = "block"
    } else {
        document.getElementById('panError').style.display = "none"
    }
}

function validateDrugLicence(drug) {
    const dlRegex = /^[A-Z]{2}[-/\s]?[A-Z0-9]{2,5}[-/\s]?(20|20B|20F|20G|21|21B)[-/\s]?[0-9]{4,8}$/i;
    if(drug.value.trim() != '' && !dlRegex.test(drug.value)) {
        document.getElementById('drugError').style.display = "block"
    } else {
        document.getElementById('drugError').style.display = "none"
    }
}

function validationNumber(elem) {
    elem.value = elem.value.replace(/\D/g, '');
    if (elem.value.length !== 10) {
        document.getElementById("mobileError").style.display = "block";
    } else {
        document.getElementById("mobileError").style.display = "none";
    }
}

function validationAlternateNumber(elem) {
    elem.value = elem.value.replace(/\D/g, '');
    if (elem.value.length !== 10) {
        document.getElementById("alternateMobileError").style.display = "block";
    } else {
        document.getElementById("alternateMobileError").style.display = "none";
    }
}

function validationWebsite(elem) {
    const urlPattern = /^(https?:\/\/)?(www\.)?[a-zA-Z0-9-]+(\.[a-zA-Z]{2,})+(\/[a-zA-Z0-9-._~:/?#[\]@!$&'()*+,;=]*)?$/;
    if (elem.value.trim() !== "" && !urlPattern.test(elem.value)) {
        document.getElementById("websiteError").style.display = "block";
    } else {
        document.getElementById("websiteError").style.display = "none";
    }
}