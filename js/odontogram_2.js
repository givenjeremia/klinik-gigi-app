
jQuery(function(){

	function drawDiente(svg, parentGroup, diente){
		if(!diente) throw new Error('Error no se ha especificado el diente.');
		
		var x = diente.x || 0,
			y = diente.y || 0;
		
		var defaultPolygon = {fill: 'white', stroke: 'navy', strokeWidth: 0.5};
		var dienteGroup = svg.group(parentGroup, {transform: 'translate(' + x + ',' + y + ')'});
		

		var caraSuperior = svg.polygon(dienteGroup,
			[[0,0],[20,0],[15,5],[5,5]],  
		    defaultPolygon);
	    caraSuperior = $(caraSuperior).data('cara', 'S');
		
		var caraInferior =  svg.polygon(dienteGroup,
			[[5,15],[15,15],[20,20],[0,20]],  
		    defaultPolygon);			
		caraInferior = $(caraInferior).data('cara', 'I');

		var caraDerecha = svg.polygon(dienteGroup,
			[[15,5],[20,0],[20,20],[15,15]],  
		    defaultPolygon);
	    caraDerecha = $(caraDerecha).data('cara', 'D');
		
		var caraIzquierda = svg.polygon(dienteGroup,
			[[0,0],[5,5],[5,15],[0,20]],  
		    defaultPolygon);
		caraIzquierda = $(caraIzquierda).data('cara', 'Z');		    
		
		var caraCentral = svg.polygon(dienteGroup,
			[[5,5],[15,5],[15,15],[5,15]],  
		    defaultPolygon);	
		caraCentral = $(caraCentral).data('cara', 'C');		    
	    
	    var caraCompleto = svg.text(dienteGroup, 6, 30, diente.id.toString(), 
	    	{fill: 'navy', stroke: 'navy', strokeWidth: 0.1, style: 'font-size: 6pt;font-weight:normal'});
    	caraCompleto = $(caraCompleto).data('cara', 'X');
    	
		//Busco los tratamientos aplicados al diente
		var tratamientosAplicadosAlDiente = ko.utils.arrayFilter(vm.tratamientosAplicados(), function(t){
			return t.diente.id == diente.id;
		});
		var caras = [];
		caras['S'] = caraSuperior;
		caras['C'] = caraCentral;
		caras['X'] = caraCompleto;
		caras['Z'] = caraIzquierda;
		caras['D'] = caraDerecha;

		for (var i = tratamientosAplicadosAlDiente.length - 1; i >= 0; i--) {
			var t = tratamientosAplicadosAlDiente[i];
			caras[t.cara].attr('fill', 'yellow');
            
		};
        console.log(tratamientosAplicadosAlDiente.length)
        //  caraCentral (C) -- Tengah
        //  caraIzquierda (Z) - Kiri
        //  caraDerecha (D) - Kanan
        //  caraInferior (I) - Bawah
        //  caraSuperior (S) - Atas
        //  caraCompleto (X) - Number
        var url = "../../backend/odontogram/data.php";
        $.ajax(url, {
            dataType: "json",
            timeout: 500, 
            success: function (data, status, xhr) {
              if (data[0].status === "oke") {
                $(".data").remove();
                data.forEach((element, key) => {
                    if(diente.id == element.data["nomor_gigi"] ){
                        if (element.data["posisi"] == 'C'){
                            caraCentral.attr('fill', element.data["color"] );
                            caraCentral.attr("class", "disabled") 
                        }
                        else if(element.data["posisi"] == 'Z'){
                            caraIzquierda.attr('fill', element.data["color"] );
                            caraIzquierda.attr("class", "disabled") 
                        }
                        else if(element.data["posisi"] == 'D'){
                            caraDerecha.attr('fill', element.data["color"] );
                            caraDerecha.attr("class", "disabled") 

                        }
                        else if(element.data["posisi"] == 'I'){
                            caraInferior.attr('fill', element.data["color"] );
                            caraInferior.attr("class", "disabled")
                        }
                        else if(element.data["posisi"] == 'S'){
                            caraSuperior.attr('fill', element.data["color"] );
                            caraSuperior.attr("class", "disabled")
                        }
                    }
                });
                
              }
            },
          });
        
		$.each([caraCentral, caraIzquierda, caraDerecha, caraInferior, caraSuperior, caraCompleto], function(index, value){
            value.click(function(){
	    		var me = $(this);
	    		var cara = me.data('cara');
                var aksi = $('#cboAksiGigi').val();
                var nomor_gigi = diente.id;
                var posisi = cara;
                alert('------')
                console.log(nomor_gigi)
        

                me.data('oldFill', me.attr('fill'));
                me.attr('fill',  aksi);
                // Ajax Add
                var data_pasien = 7
                var form_data = new FormData();
                form_data.append('pasien',data_pasien)
                form_data.append('nomor_gigi',nomor_gigi)
                form_data.append('posisi',posisi)
                form_data.append('rekam_medis',13)
                form_data.append('status','Tambalan')
                form_data.append('color','red')
                var url = "../../backend/odontogram/insert.php";
                $.ajax({
                type: "POST",
                url: url,
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == "success") {
                    Swal.fire({
                        title: "Success",
                        text: "Odontogram Berhasil Ditambahkan",
                        icon: "success",
                        showConfirmButton: true,
                    }).then((result) => {
                        getData();
                        me.attr("class", "disabled")
                    });
                    } else {
                    Swal.fire({
                        title: "Error",
                        text: "Odontogram Gagal Di Tambahkan",
                        icon: "error",
                        showConfirmButton: true,
                    });
                    }
                },
                });
               
				

				// if(!vm.tratamientoSeleccionado()){
				// 	alert('Debe seleccionar un tratamiento previamentess.');	
				// 	return false;
				// }

				//Validaciones
				//Validamos el tratamiento
				// var tratamiento = vm.tratamientoSeleccionado();

				// if(cara == 'X' && !tratamiento.aplicaDiente){
				// 	alert('El tratamiento seleccionado no se puede aplicar a toda la pieza.');
				// 	return false;
				// }
				// if(cara != 'X' && !tratamiento.aplicaCara){
				// 	alert('El tratamiento seleccionado no se puede aplicar a una cara.');
				// 	return false;
				// }
				//TODO: Validaciones de si la cara tiene tratamiento o no, etc...

				vm.tratamientosAplicados.push({diente: diente, cara: cara});
				vm.tratamientoSeleccionado(null);
				
				//Actualizo el SVG
				renderSvg();
	    	}).mouseenter(function(){
	    		var me = $(this);
	    		me.data('oldFill', me.attr('fill'));
	    		// me.attr('fill', 'red');
                me.attr('fill',  $('#cboAksiGigi').val());
	    	}).mouseleave(function(){
	    		var me = $(this);
	    		me.attr('fill', me.data('oldFill'));
                
	    	});			
		});
	};

	function renderSvg(){
		console.log('update render');

		var svg = $('#odontograma').svg('get').clear();
		var parentGroup = svg.group({transform: 'scale(1.5)'});
		var dientes = vm.dientes();
		for (var i =  dientes.length - 1; i >= 0; i--) {
			var diente =  dientes[i];
			var dienteUnwrapped = ko.utils.unwrapObservable(diente); 
			drawDiente(svg, parentGroup, dienteUnwrapped);
		};
	}

	//View Models
	function DienteModel(id, x, y){
		var self = this;
		// alert(id);
		self.id = id;	
		self.x = x;
		self.y = y;		
	};

	function ViewModel(){
		var self = this;

		self.tratamientosPosibles = ko.observableArray([]);
		self.tratamientoSeleccionado = ko.observable(null);
		self.tratamientosAplicados = ko.observableArray([]);

		self.quitarTratamiento = function(tratamiento){
			self.tratamientosAplicados.remove(tratamiento);
			renderSvg();
		}

		//Cargo los dientes
		var dientes = [];
		//Dientes izquierdos
		for(var i = 0; i < 8; i++){
			dientes.push(new DienteModel(18 - i, i * 25, 0));	
		}
		for(var i = 3; i < 8; i++){
			dientes.push(new DienteModel(55 - i, i * 25, 1 * 40));	
		}
		for(var i = 3; i < 8; i++){
			dientes.push(new DienteModel(85 - i, i * 25, 2 * 40));	
		}
		for(var i = 0; i < 8; i++){
			dientes.push(new DienteModel(48 - i, i * 25, 3 * 40));	
		}
		//Dientes derechos
		for(var i = 0; i < 8; i++){
			dientes.push(new DienteModel(21 + i, i * 25 + 210, 0));	
		}
		for(var i = 0; i < 5; i++){
			dientes.push(new DienteModel(61 + i, i * 25 + 210, 1 * 40));	
		}
		for(var i = 0; i < 5; i++){
			dientes.push(new DienteModel(71 + i, i * 25 + 210, 2 * 40));	
		}
		for(var i = 0; i < 8; i++){
			dientes.push(new DienteModel(31 + i, i * 25 + 210, 3 * 40));	
		}

		self.dientes = ko.observableArray(dientes);
		// console.log(dientes[0].id)
	};

	vm = new ViewModel();
	
	//Inicializo SVG
    $('#odontograma').svg({
        settings:{ width: '620px', height: '250px' }
    });

	ko.applyBindings(vm);

	//TODO: Cargo el estado del odontograma
	renderSvg();



});