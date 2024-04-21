@extends('layouts.app')
{{-- <link href="{{url('css/custome-table.css')}}" rel="stylesheet" type="text/css"> --}}

@section('content')

<div id = "app">
	<a  @click="printjs" class="btn  btn-success">
		<i class="fa fa-print"></i> @lang('layout.Print')
	</a>
</div>

@stop

@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://unpkg.com/jspdf-autotable@3.8.2/dist/jspdf.plugin.autotable.js"></script> --}}

<script src="{{ url('/js/jspdf.umd.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/jspdf.plugin.autotable.js') }}" type="text/javascript"></script>

    <script>

//this is a vue js vue 2

    let v = new Vue({
            el: '#app',
            data: {
                
            },
            methods: {
                printjs(){
                    const { jsPDF } = jspdf
                    const {autoTable} ='jspdf-autotable'
                    const doc = new jsPDF({
                        orientation: 'p',
                        unit: 'mm',
                        format: 'a4',
						//to add password to a pdf file
                        encryption: {
                            userPassword: "user",
                            ownerPassword: "saeed",
                            userPermissions: ["print", "modify", "copy", "annot-forms"]
                        }
                    });
                    // for(var i=0; i<=100;i++){

                    //     doc.text("Hello world!", 10, 10);
                    // }
                    // doc.save("a4.pdf");

                    // var body = [
                    //         ['SL.No', 'Product Name', 'Price', 'Model'],
                    //         [1, 'I-phone', 75000, '2021'],
                    //         [2, 'Realme', 25000, '2022'],
                    //         [3, 'Oneplus', 30000, '2021'],
                    //         ]
                    // var y = 10;
                    // doc.setLineWidth(2);
                    // doc.text(200, y = y + 30, "Product detailed report");
                    // doc.autoTable({
                    //     head:[['name','age','country']],
                    //     body: [['saeed',28,'afg'],['saeed',28,'afg']]
                    // })
                    // doc.save('auto_table_with_javascript_data');


                    // var body = [
                    //         ['SL.No', 'Product Name', 'Price', 'Model'],
                    //         [1, 'I-phone', 75000, '2021'],
                    //         [2, 'Realme', 25000, '2022'],
                    //         [3, 'Oneplus', 30000, '2021'],
                    //         ]


                    // var body = this.note_all;
                    // var y = 10;
                    // doc.setLineWidth(2);
                    // doc.text("Hello world!", 10, 10);
                    // doc.autoTable({
                    //     body: body,
                    //     startY: 70,
                    //     theme: 'grid',
                    //             })
                    // doc.save('auto_table_with_javascript_data');

                    axios.get("{{route('test.create')}}")
                    .then(function (response) {

                        var fontPath = "{{url('Farsi_font/'.getFont().'.ttf')}}";
                        var logoPath = "{{url('uploads/logo.png')}}";
                        
                        console.log('daaaaaaaaaaa',response,fontPath,logoPath);
                        var body = response.data.note_all;
                        var company_name = response.data.company_name;
                        var company_phone = response.data.company_phone;
                        var y = 10;
                        doc.addFileToVFS("CustomeFont.ttf", fontPath);
                        doc.addFont(fontPath, 'CustomeFont', 'normal');
                        doc.setFont('CustomeFont');
                        doc.setLineWidth(2);
                        // doc.text("Test Company this is a header", 10, y=y+10);
                        doc.autoPrint({variant: 'non-conform'});
                        doc.setTextColor(40);
                        doc.setDirection = "rtl";
                        // doc.setLanguage("en-US");

                        // const pageCount = doc.internal.getNumberOfPages();
                        // for (let i = 1; i <= pageCount; i++) {
                        //     doc.setPage(i);
                        //     doc.text('Page ' + String(i)+ ' of ' + String(pageCount),100,285,null,null,"right");
                        // }

                        if (logoPath) {
                            doc.addImage(logoPath, "png", 10, 15, 10, 10);
                        }
                        doc.setFontSize(25);
                        doc.setTextColor(255,0,0)

                        doc.text(company_name, 10 + 60, 22)

                        doc.setFontSize(12);
                        doc.setTextColor(255,0,0)

                        doc.text(company_phone, 10 + 170, 22)
                        
                        doc.setLineWidth(0.2);
                        doc.line(10, y+18, 200, y+18);


                        doc.autoTable({
                            body: body,
                            // html: '#noteList',
                            startY: 30,
                            // head:[['Date','Number','Amount','Currency']],
                            columns: [
                                { dataKey: 'id', header: '@lang("layout.ID")' },
                                { dataKey: 'name', header: '@lang("layout.Name")' },
                                { dataKey: 'fatherName', header: '@lang("layout.FatherName")' },
                                { dataKey: 'description', header: '@lang("layout.Description")' },
                                // { dataKey: 'description', header: '@lang("layout.Description")' }
                            ],
                            foot:[['','','Amount','Currency','']],
                            theme: 'grid',
                            // theme: 'striped',
                            tableLineWidth:0.5,
                            // tableLineColor:[200,80,120],
                            tableLineColor: [231, 76, 60],
                            headStyles: {
                                fillColor: [241, 196, 15],
                                fontSize: 15,
                            },
                            footStyles: {
                                fillColor: [241, 196, 15],
                                fontSize: 15,
                            },
                            styles:{
                                font:'CustomeFont',
                                fontSize:12,
                                cellPadding:1,
                                lineWidth:0.2,
                                lineColor:[200,80,120],
                                float: "rtl",

                            },
                            columnStyles:{
                                0: {
                                    halign: 'left',
                                    valign:'middle',
                                    tableWidth: 100,
                                    fillColor:[232,252,245],
                                    cellWidth:'auto'
                                },
                                1: {
                                    halign: 'center',
                                    valign:'middle',
                                    tableWidth: 100,
                                    fillColor:[232,252,245],
                                    cellWidth:'auto'
                                },
                                2: {
                                    halign: 'left',
                                    valign:'middle',
                                    tableWidth: 100,
                                    fillColor:[232,252,245],
                                    cellWidth:'auto'
                                },
                                3: {
                                    halign: 'right',
                                    valign:'middle',
                                    tableWidth: 100,
                                    fillColor:[232,252,245],
                                    cellWidth:'auto'
                                },
                                // 4: {
                                //     halign: 'center',
                                //     valign:'middle',
                                //     tableWidth: 100,
                                //     fillColor:[232,252,245],
                                //     cellWidth:'auto'
                                // }
                            },
                            didDrawPage: function(data) {
                                console.log(data);

                                var currentdate = new Date(); 
                                var datetime =   currentdate.getDate() + "/"
                                                + (currentdate.getMonth()+1)  + "/" 
                                                + currentdate.getFullYear() + " ----- "  
                                                + currentdate.getHours() + ":"  
                                                + currentdate.getMinutes() + ":" 
                                                + currentdate.getSeconds();
                                // const currentPage = data.pageNumber;
                                // const pageNumber = `Page ${currentPage} - ${datetime}`;
                                // doc.setFontSize(10);
                                // doc.text(pageNumber,100,285);

                                // const pageCount = doc.internal.getNumberOfPages();
                                // for (let i = 1; i <= pageCount; i++) {
                                //     doc.setFontSize(10);
                                //     doc.setPage(i);
                                //     doc.text('Page ' + String(i)+ ' of ' + String(pageCount),100,285,null,null,"right");
                                // }

                                doc.setFontSize(20);
                                doc.setTextColor(255,0,0)
                                // doc.text("CHACO Company  - َشرکت حسابدار خبره", 10, 10);
                                // doc.addImage(logoPath, "png", 10, 10, 10, 10);


                                // if (logoPath) {
                                //     doc.addImage(logoPath, "png", data.settings.margin.left, 15, 10, 10);
                                // }
                                // doc.text('Report', data.settings.margin.left + 80, 22)
                                // doc.text('Phone', data.settings.margin.left + 120, 22)


                                // doc.line(3, 70, margins.width + 43,70);
                                // doc.setLineWidth(0.2);
                                // doc.line(10, y+18, 200, y+18);

                               
                                
                                
                                //create image data using base64
                                // var imgData = 'data:image/jpeg;base64,'+ Base64.encode('Koala.jpeg');
                                // doc.addImage(imgData, 'JPEG', 10, 10, 200, 200);


                                // doc.setLineWidth(1);
                                // doc.line(10, y, 200, y);
                            }
                        })

                        //Second Table
                        doc.autoTable({
                            columns: [
                                { dataKey: 'id', header: '@lang("layout.ID")' },
                                { dataKey: 'name', header: '@lang("layout.Name")' },
                                { dataKey: 'fatherName', header: '@lang("layout.FatherName")' },
                                { dataKey: 'description', header: '@lang("layout.Description")' }
                            ],
                            body: body,
                            // startY: 240,
                            // showHead: 'firstPage',
                            styles:{
                                font:'CustomeFont',
                                fontSize:12,
                                // cellPadding:1,
                                // lineWidth:0.2,
                                // lineColor:[200,80,120]

                            },
                            // margin: { left: 107 },
                            didDrawPage: function(data) {
                                console.log(data);

                                var currentdate = new Date(); 
                                var datetime =   currentdate.getDate() + "/"
                                                + (currentdate.getMonth()+1)  + "/" 
                                                + currentdate.getFullYear() + " ----- "  
                                                + currentdate.getHours() + ":"  
                                                + currentdate.getMinutes() + ":" 
                                                + currentdate.getSeconds();

                                // const currentPage = data.pageNumber;
                                // const pageNumber = `Page ${currentPage} - ${datetime}`;
                                
                                // doc.text(pageNumber,100,285);

                                doc.setFontSize(20);
                                doc.setTextColor(255,0,0)
                                // doc.text("CHACO Company  - َشرکت حسابدار خبره", 10, 10);
                                // doc.line(3, 70, margins.width + 43,70);

                               
                            }
                        })


                        //Page Number
                        const pageCount = doc.internal.getNumberOfPages();
                        for (let i = 1; i <= pageCount; i++) {
                            doc.setPage(i);
                            doc.setFontSize(10);
                            doc.setTextColor(255,0,0)
                            doc.text('Page ' + String(i)+ ' of ' + String(pageCount),100,285,null,null,"right");
                        }

                        


                        doc.save('auto_table_with_javascript_data_pdf');

						
                    })
                    .catch(function (error) {
                    });




                },

     

            }
        })


    </script>
@endpush