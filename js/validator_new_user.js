function validateText(id)
    {
        var reg = /^[A-Z][a-z0-9_-]{3,19}$/;
        if($("#"+id).val()==null || $("#"+id).val()=="")
        {

                       
                       $("#"+id).focus();
                       return false;

        }
        else if(!($("#"+id).val().match(reg)))
            {
                       $("#"+id).focus();
                       return false;
            }
        else
            {
              
               return true;
            }
    }
function validatephone(id)
    {
        var reg = /^[0-9]{10,11}$/;
        if($("#"+id).val()==null || $("#"+id).val()=="")
        {
                       $("#"+id).focus();
                       return false;

        }
        else if(!($("#"+id).val().match(reg)))
            {
                      $("#"+id).focus();
                       return false;
            }
        else
            {
               return true;
            }
    }

function validateemail(id)
    {
        var reg = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if($("#"+id).val()==null || $("#"+id).val()=="")
        {
                       $("#"+id).focus();
                       return false;

        }
        else if(!($("#"+id).val().match(reg)))
            {
                      $("#"+id).focus();
                       return false;
            }
        else
            {
               return true;
            }
    }

function validatepass(id)
    {
        var reg = /^[a-zA-Z0-9]{8,}$/;
        if($("#"+id).val()==null || $("#"+id).val()=="")
        {
                      $("#"+id).focus();
                       return false;

        }
        else if(!($("#"+id).val().match(reg)))
            {
                       $("#"+id).focus();
                       return false;
            }
        else
            {
               return true;
            }
    }
function recheckpass(id)
    {
        if($("#"+id).val()==null || $("#"+id).val()=="")
        {

                       
                       $("#"+id).focus();
                       return false;

        }
        else if(!($("#"+id).val() == $("#password").val()))
            {
                
                       $("#"+id).focus();
                       return false;
            }
        else
            {
               
               return true;
            }
    }

$(document).ready(

          function()
        {
            $("#fname").blur(function()

              {
                  if(!validateText("fname"))
                      {
                          return false;
                      }
              }
            );

        }

     );

$(document).ready(

          function()
        {
            $("#lname").blur(function()

              {
                  if(!validateText("lname"))
                      {
                          return false;
                      }
              }
            );

        }

     );

 $(document).ready(

          function()
        {
            $("#contact").blur(function()

              {
                  if(!validatephone("contact"))
                      {
                          return false;
                      }
              }
            );

        }

     );

 $(document).ready(

          function()
        {
            $("#email").blur(function()

              {
                  if(!validateemail("email"))
                      {
                          return false;
                      }
              }
            );

        }

     );

$(document).ready(

          function()
        {
            $("#password").blur(function()

              {
                  if(!validatepass("password"))
                      {
                          return false;
                      }
              }
            );

        }

     );

         $(document).ready(

          function()
        {
            $("#confirmpass").blur(function()

              {
                  if(!recheckpass("confirmpass"))
                      {
                          return false;
                      }
              }
            );

        }

     );