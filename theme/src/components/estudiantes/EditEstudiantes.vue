<template>
	<div v-if="loading == 1" class="row" style="font-size: 20px;display: flex;justify-content: center;">
		<div class="spinner-border" style="width: 3rem; height: 3rem;color:#008000;" role="status">
			<span class="visually-hidden">Loading...</span>
		</div>
	</div>

	<div v-if="loading == 0" class="row">
		<div class="col-12" align="right">
			<button type="button" class="btn btn-primary mb-4" @click="$router.push({name: 'inicio'});">Atrás</button>
		</div>
	</div>

	<div v-if="loading == 0 && errores != false" class="row">
		<div class="col-12">
			<div id="error_explanation">
				<h2>Ocurrio los siguientes errores: </h2>
				<ul>
					<li v-for="(item, index) in errores" :key="index" v-text="item"></li>
				</ul>
			</div>
		</div>
	</div>

	<form v-if="loading == 0" @submit.prevent="save()">
		<div class="row">
			<div class="col-4">
				<input type="text" class="form-control" placeholder="Nombres" aria-label="Nombres" v-model="nombres" required>
			</div>
			<div class="col-4">
				<input type="text" class="form-control" placeholder="Apellidos" aria-label="Apellidos" v-model="apellidos" required>
			</div>
			<div class="col-4">
				<select class="form-select" aria-label="Tipo de documento" :value="tipoDocumento" @change="setTipoDocumento($event)" required>
					<option value="CC">Cédula de ciudadanía</option>
					<option value="TI">Tarjeta de identidad</option>
					<option value="CE">Cédula extranjera</option>
				</select>
			</div>
			<div class="col-4 mt-4">
				<input type="text" class="form-control" placeholder="Documento" aria-label="Documento" v-model="documento" required>
			</div>
			<div class="col-4 mt-4">
				<select class="form-select" aria-label="Genero" :value="genero" @change="setGenero($event)" required>
					<option value="H">Hombre</option>
					<option value="M">Mujer</option>
					<option value="O">Otro</option>
				</select>
			</div>
			<div class="col-4 mt-4">
				<input class="form-control" id="date" name="date" placeholder="Fecha de nacimiento" type="date" v-model="fechaNacimiento" @change="setFechaNacimiento($event)" required/>
			</div>
			<div class="col-4 mt-4">
				<input type="text" class="form-control" placeholder="Carrera" aria-label="Carrera" v-model="carrera" required>
			</div>
		</div>

		<div class="row">
			<div class="col-12" align="right">
				<button type="submit" class="btn btn-success mb-4">Guardar</button>
			</div>
		</div>
	</form>
</template>

<script>
import estudiantes from '@/store/estudiantes/';

export default {
	data() {
		return {
			loading: 0,
			errores: false,
			estudiante: "",
			nombres: "",
			apellidos: "",
			tipoDocumento: "",
			documento: "",
			genero: "",
			fechaNacimiento: "",
			carrera: "",
		}
	},

	props: {
        idEstudiante: {
            type: String,
            default: '0'
        },
    },

	async mounted(){
        const response = await estudiantes.dispatch('findByID', { id: this.idEstudiante});

		if (response.success){
			this.estudiante = response.data;
		} else {
			this.estudiante = false;
		}

		this.initForm();
	},

	methods: {
		async save(){
			this.loading = 1;
			const response = await estudiantes.dispatch('update', {
				id: this.idEstudiante,
				nombres: this.nombres,
				apellidos: this.apellidos,
				tipoDocumento: this.tipoDocumento,
				documento: this.documento,
				genero: this.genero,
				fechaNacimiento: this.fechaNacimiento,
				carrera: this.carrera,
			});

			if (!response.success){
				this.errores = response.errors;
			}

			this.loading = 0;
		},

		initForm(){
			const date = this.estudiante.fechaNacimiento.split(' ');
			this.nombres = this.estudiante.nombres;
			this.apellidos = this.estudiante.apellidos;
			this.tipoDocumento = this.estudiante.tipoDocumento;
			this.documento = this.estudiante.documento;
			this.genero = this.estudiante.genero;
			this.fechaNacimiento = date[0];
			this.carrera = this.estudiante.carrera;
		},

		setTipoDocumento(event){
			this.tipoDocumento = event.target.value;
		},

		setGenero(event){
			this.genero = event.target.value;
		},

		setFechaNacimiento(event){
			this.fechaNacimiento = event.target.value;
		}
	}
}
</script>