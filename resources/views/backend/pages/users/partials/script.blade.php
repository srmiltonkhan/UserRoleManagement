{{-- When User Click on All Checkbox then Select all Checkbox Area --}}
<script>
    $('#checkAll').click(function(){
        if($(this).is(':checked')){
            $('input[type=checkbox]').prop('checked', true)
        }else{
            $('input[type=checkbox]').prop('checked', false)
        }
    })

// When user click on group check box then seleted under the gropu checkbox

    function checkPermissionByGroup(className, checkThis){
        const groupIdName = $("#"+checkThis.id)
        const classCheckBox = $('.'+className+' input')
        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked', true)
        }else{
            classCheckBox.prop('checked', false)
        }
    }
// When user click on single permisson checkbox then all fillup cheec gropu permisson checkbox true.
    function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);
            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true)
            }else{
                groupIDCheckBox.prop('checked', false)
            }
            implementAllChecked();
         }

        $('.groupCheckBox').click(function(){
            implementAllChecked();
        })

        function implementAllChecked() { 
        var unCheckedLen = $('.AllCheckBoxStatus input[type="checkbox"]').length;
        var checkedLen = $('.AllCheckBoxStatus input[type="checkbox"]:checked').length;
        if(unCheckedLen == checkedLen){
            $("#checkAll").prop('checked', true); 
        }else{
            $("#checkAll").prop('checked', false);
        }
     }

</script>