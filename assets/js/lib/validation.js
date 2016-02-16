// JavaScript Document
function validateForm()
{
	var x=document.forms["submit_form"]["sub_name"].value;	
if (x==null || x=="" )
  {
  alert("Name must be filled out");
  return false;
  } 
  	var x=document.forms["submit_form"]["sub_phone"].value;
if (x==null || x=="")
  {
  alert("Phone field must be filled out");
  return false
  } 
	var x=document.forms["submit_form"]["sub_email"].value;
if (x==null || x=="")
  {
  alert("Email field name must be filled out");
  return false;
  } 
  	var x=document.forms["submit_form"]["sub_phone"].value;
if (x==null || x=="")
  {
  alert("Phone field must be filled out");
  return false;
  }
  	var x=document.forms["submit_form"]["sub_date"].value;
if (x==null || x=="")
  {
  alert("Date must be specified");
  return false; 
  }
  
  $.post(location.origin + '/api/email', $( '#submit_form' ).serialize(), function(data) {
    
      if (data.objects == 1) {
        alert('Thank you! Your message has been received, usually we respond within 24 hours.');
        document.forms["submit_form"]["sub_name"].value = '';
        document.forms["submit_form"]["sub_phone"].value = '';
        document.forms["submit_form"]["sub_email"].value = '';
        document.forms["submit_form"]["sub_phone"].value = '';
        document.forms["submit_form"]["sub_date"].value = '';
        $('.dropdown-menu').dropdown("toggle");
        location.reload();
        // document.forms["submit_form"]["captcha"].value = '';
      };
  });
  return false; 
}

function validateFormMobile()
{
  var x=document.forms["submit_form_mobile"]["sub_name"].value;  
if (x==null || x=="")
  {
  alert("Name must be filled out");
  return false;
  } 
  
    var x=document.forms["submit_form_mobile"]["sub_phone"].value;
if (x==null || x=="")
  {
  alert("Phone field must be filled out");
  return false
  } 
  var x=document.forms["submit_form_mobile"]["sub_email"].value;
if (x==null || x=="")
  {
  alert("Email field name must be filled out");
  return false;
  } 
var x=document.forms["submit_form_mobile"]["sub_phone"].value;
if (x==null || x=="")
  {
  alert("Phone field must be filled out");
  return false;
  }
    var x=document.forms["submit_form_mobile"]["sub_date"].value;
if (x==null || x=="")
  {
  alert("Date must be specified");
  return false; 
  }
  
  $.post(location.origin + '/api/email', $( '#submit_form_m' ).serialize(), function(data) {
    
      if (data.objects == 1) {
        alert('Thank you! Your message has been received, usually we respond within 24 hours.');
        document.forms["submit_form_mobile"]["sub_name"].value = '';
        document.forms["submit_form_mobile"]["sub_phone"].value = '';
        document.forms["submit_form_mobile"]["sub_email"].value = '';
        document.forms["submit_form_mobile"]["sub_phone"].value = '';
        document.forms["submit_form_mobile"]["sub_date"].value = '';
        $('.dropdown-menu').dropdown("toggle");
        location.reload();
      };
  });
  return false; 
}

function validateForm2()
{
  var x=document.forms["submit_subscribe"]["email"].value;
if (x==null || x=="")
  {
  alert("Email field name must be filled out");
  return false;
  } 

  $.post(location.origin + '/api/subscribe', $( '#submit_subscribe' ).serialize(), function(data) {
    
      if (data.objects == 1) {
        alert('Thank you!');
        document.forms["submit_subscribe"]["email"].value = '';
      };
  });
  return false; 
}



function validateSub()
{
var x=document.forms["submit_form"]["sub_email_subscriber"].value;
if (x==null || x=="")
  {
  alert("Email address must be specified");
  return false;
  } 
}