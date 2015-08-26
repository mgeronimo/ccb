
var form = $('#addgroup').show();

form.steps({
	bodyTag:"fieldset",
	transitionEffect:"slideleft"
	onStepChanging: function(event, currentIndex, newIndex)
	{
		  if (currentIndex > newIndex)
        {
            return true;
        }
         if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        // form.validate().settings.ignore = ":disabled,:hidden";
         //return form.valid();
	}
	onStepChanged: function (event, currentIndex, priorIndex)
    {
        // Used to skip the "Warning" step if the user is old enough.
        if (currentIndex === 2 )
        {
            form.steps("next");
        }
        // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
        if (currentIndex === 2 && priorIndex === 3)
        {
            form.steps("previous");
        }
    },

    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
}); 

