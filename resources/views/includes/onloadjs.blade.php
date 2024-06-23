<script>
    $(document).ready(function(){
        let company_id_check = document.getElementById('company_id_check').value;
        let department_id_check = document.getElementById('department_id_check').value;
        let year_post_check = document.getElementById('year_post_check').value;

        if(!company_id_check && !department_id_check){
            return
        }
        $('#modalManual2').modal('show');
        let irene;
        let irene1;
        let irene2;
        let irene3;
        $.ajax({
            async: false,
            type: 'GET', //THIS NEEDS TO BE GET
            url: '{{url("/ajax_chart")}}'+'/'+company_id_check+'/'+department_id_check+'/'+year_post_check,
            success: function (responsedata) {
                irene = responsedata[0];
                irene1 = responsedata[1];
                irene2 = responsedata[2];
                irene3 = responsedata[3];
            },
            error: function() { 
                
            }
        });
        
    
        setTimeout(() => {
            document.getElementById('organ_chart').innerHTML=  irene3.department_name;
            document.getElementById('tree').style.backgroundImage="url("+irene2.url_to+")";
            
            OrgChart.templates.mery.field_3 = '<text data-width="230" data-text-overflow="multiline-4-ellipsis" style="font-size: 20px; display:none;" fill="#fff" x="10" y="28" text-anchor="start">{val}</text>';
            OrgChart.elements.myTextArea = function (data, editElement, minWidth, readOnly) {
                var id = OrgChart.elements.generateId();
                readOnly = true;
                var value = data[editElement.binding];
                if (value == undefined) value = '';
                if (readOnly && !value) {
                    return {
                        html: ''
                    };
                }
    
                return {
                    html: `
                        <div class="boc-form-field" style="min-width: 280px;">
                            <div class="boc-input">
                                <label style="top:0px;" for="${id}">${editElement.label}</label>
                                <input type="text" disable readonly id="${id}" name="${id}" value="${value}" style="width: 100%;" data-binding="${editElement.binding}">
                            </div>
                        </div>    
                    `,
                    id: id,
                    value: value
                };
    
            };
            
            var webcallMeIcon = '<svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 640 512" fill><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#FFF" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg>';
            var calendar = '<svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z"/></svg>';
            OrgChart.templates.mery.field_3 = '<text class="field_3" style="font-size: 16px;" fill="#ffffff" x="180" y="70" text-anchor="middle">{val}</text>';
           
            var chart = new OrgChart(document.getElementById("tree"), {
                template: "mery",
                mouseScrool: OrgChart.none,
                nodeBinding: {
                    field_0: "Employee Name",
                    field_1: "Title",
                    img_0: "Photo",
                    field_2: "link",
                    field_3: "irene"
                },
                linkBinding: {
                    link_field_0: "section"
                },
                editForm: {
                        generateElementsFromFields: false,
                        titleBinding: "Employee Name",
                        photoBinding: "Photo",
                        elements: [
                            { type: 'myTextArea', label: 'Full Name', binding: 'Employee Name'},
                            { type: 'myTextArea', label: 'Position', binding: 'Title'},
                            { type: 'textbox', label: 'Update Photo', binding: 'ImgUrl', btn: 'Upload'},
                            { type: 'textbox', label: 'Section', binding: 'Section'},
                            {
                                type: 'select',
                                label: 'Subordinate',
                                binding: 'Subordinate',
                                options: irene1
                            },
                            {
                                type: 'select',
                                label: 'Assistant',
                                binding: 'Assistant',
                                options: [
                                    { value: '0', text: 'NO' },
                                    { value: '1', text: 'YES' }
                                ],
                                btn: 'Upload'
                            },  
    
                            
                        ],
                        buttons:  {
                            edit: {
                                icon: OrgChart.icon.edit(24,24,'#fff'),
                                text: 'ADD Subordinate',
                                hideIfEditMode: true,
                                hideIfDetailsMode: false
                            },
                            share:null,
                            pdf: {
                                icon: OrgChart.icon.pdf(24,24,'#fff'),
                                text: 'Save as PDF'
                            },
                            remove: {
                                icon: OrgChart.icon.remove(24,24,'#fff'),
                                text: 'Remove',
                                hideIfDetailsMode: true
                            },
                            call: {
                                text: "KPI Details",
                                icon: webcallMeIcon,
                            },
                            kpiupdate: {
                                text: "KPI UPDATE",
                                icon: calendar,
                            }
                            
                        }
                    }, 
                nodeMenu: {
                    details: { text: "Details" },
                    edit: { text: "Add Subordinate" },
                    remove: { text: "Remove" },
                    
                },
                toolbar: {
                    fullScreen: true,
                    zoom: true,
                    fit: true,
                    expandAll: true
                },
                nodeContextMenu: {
                    edit: { text: "ADD Subordinate", icon: OrgChart.icon.edit(18, 18, '#039BE5')  },
    
                    remove: { text: "Remove Subordinate", icon: OrgChart.icon.edit(18, 18, '#039BE5')  },
                },
            });
            
            chart.editUI.on('button-click', function (sender, args) {
                if (args.name == 'call') {
                    let data = chart.get(args.nodeId);
                    document.getElementById('user_id_post').value = data.id;
                    // INSERT MODAL AND KPI DETAILS
                    
                    let user_id = document.getElementById('user_id_post').value;
                    let company_id = document.getElementById('company_id_check').value;
                    let year_post = document.getElementById('year_post_check').value;
                    let department_id = document.getElementById('department_id_check').value;
                    
                    $.ajax({
                        async: false,
                        type: 'GET', //THIS NEEDS TO BE GET
                        url: '{{url("/get_detail")}}'+'/'+user_id+'/'+company_id+'/'+year_post,
                        success: function (responsedata) {
                            // console.log(responsedata);
                            // document.getElementById('vision_post').innerHTML = responsedata.data.vision;
                            // document.getElementById('mission1_post').innerHTML = responsedata.data.mission1;
                            // document.getElementById('mission2_post').innerHTML = responsedata.data.mission2;
                            // document.getElementById('department_vision_post').innerHTML = responsedata.data.department_vision;
                            // document.getElementById('strategy_post').innerHTML = responsedata.data.strategy;
                            // document.getElementById('objectives_post').innerHTML = responsedata.data.objectives; 
                            if(responsedata.success)
                            {  
                                window.location = responsedata.url
                            }
                        },
                        error: function() { 
                            
                        }
                    });
    
                    // $('#modalKpi').modal('show');
                }
                if (args.name == 'kpiupdate') {
                        let data = chart.get(args.nodeId);
                        document.getElementById('user_id_post').value = data.id;
                        // INSERT MODAL AND KPI DETAILS
                    
                        let user_id = document.getElementById('user_id_post').value;
                        let company_id = document.getElementById('company_id_check').value;
                        let year_post = document.getElementById('year_post_check').value;
                        let department_id = document.getElementById('department_id_check').value;
                        
                        $.ajax({
                            async: false,
                            type: 'GET', //THIS NEEDS TO BE GET
                            url: '{{url("/get_detail_two")}}'+'/'+user_id+'/'+company_id+'/'+year_post,
                            success: function (responsedata) {
                                if(responsedata.success)
                                {  
                                    window.location = responsedata.url
                                }
                            },
                            error: function() { 
                                
                            }
                    });
                }
            });
    
            chart.on('label', function (sender, args) {
                args.value = args.value;
            });
    
            chart.on('remove', function (sender, nodeId) {
                let company_id = document.getElementById('company_id_check').value;
                let department_id = document.getElementById('department_id_check').value;
                $.ajax({
                    async: false,
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '{{url("/delete_org")}}'+'/'+nodeId+'/'+company_id,
                    success: function (responsedata) {
                        check2();
                    },
                    error: function() { 
                        if(data ==='ERROR2'){
                            setTimeout(() => {
                                document.getElementById('error2').style.display = 'block';
                            }, "3500");
    
                            setTimeout(() => {
                                document.getElementById('error2').style.display = 'none';
                            }, "8000");
                        }
                        else{
                            setTimeout(() => {
                                document.getElementById('deleted').style.display = 'block';
                            }, "3500");
    
                            setTimeout(() => {
                                document.getElementById('deleted').style.display = 'none';
                            }, "8000");
                        } 
                    }
                });
                
            });
    
            chart.on('update', function (sender, node,binding) {   
                let company_id = document.getElementById('company_id_check').value;
                let department_id = document.getElementById('department_id_check').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:"{{ route('post_org') }}",
                    data:{
                        _token: CSRF_TOKEN,
                        pid:binding.id,
                        subordinate:binding.Subordinate,
                        assistant:binding.Assistant,
                        section: binding.Section,
                        company_id:company_id,
                        department_id:department_id
                    },
                    success:function(data){
                        check2();
                        console.log(data);
                        if(data ==='ERROR'){
                            setTimeout(() => {
                                document.getElementById('error1').style.display = 'block';
                            }, "3500");
    
                            setTimeout(() => {
                                document.getElementById('error1').style.display = 'none';
                            }, "8000");
                        }
                        else{
                            setTimeout(() => {
                                document.getElementById('added').style.display = 'block';
                            }, "3500");
    
                            setTimeout(() => {
                                document.getElementById('added').style.display = 'none';
                            }, "8000");
                        }
                    }
                });
                return false;
            });
    
            chart.load(irene);
            
        }, "3000");
    
        setTimeout(function(){
            $('#modalManual2').modal('hide');
        },4000)
        
    });
    </script>