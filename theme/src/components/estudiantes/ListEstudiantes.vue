<template>
	<div v-if="loading == 1" class="row" style="font-size: 20px;display: flex;justify-content: center;">
		<div class="spinner-border" style="width: 3rem; height: 3rem;color:#008000;" role="status">
			<span class="visually-hidden">Loading...</span>
		</div>
	</div>

	<div v-if="loading == 0" class="row">
		<div class="col-12" align="right">
			<button type="button" class="btn btn-primary mb-4" @click="$router.push({name: 'RegistroEstudiantes'});">Nuevo</button>
		</div>
	</div>

	<div v-if="loading == 0" class="row">
		<div class="col-12">
			<table class="table align-middle mb-0 bg-white">
				<thead class="bg-light table-dark">
					<tr>
						<th>Name</th>
						<th>Carrera</th>
						<th>Fecha nacimiento</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in estudiantes" :key="item.id">
						<td>
							<div class="d-flex align-items-center">
								<img
								:src="'https://mdbootstrap.com/img/new/avatars/' + item.id + '.jpg'"
								alt=""
								style="width: 45px; height: 45px"
								class="rounded-circle"
								/>
								<div class="ms-3">
									<div class="text-muted mb-0"><b>Documento: </b> <small v-text="item.documento"></small></div>
									<p class="fw-bold mb-1" v-text="item.nombres + ' ' + item.apellidos"></p>
								</div>
							</div>
						</td>
						<td>
							<p class="fw-normal mb-1" v-text="item.carrera"></p>
						</td>
						<td v-text="item.fechaNacimiento"></td>
						<td>
							<button type="button" class="btn btn-success" style="margin-right: 2vh" @click="$router.push({name: 'EditarEstudiante', params: { id: item.id }});">Editar</button>
							<button type="button" class="btn btn-danger" @click="deleteEstudiante(item.id)">Eliminar</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
import estudiantes from '@/store/estudiantes/';

export default {
	data() {
		return {
			estudiantes: false,
			loading: 1,
		}
	},

	async mounted(){
        const response = await estudiantes.dispatch('findAll');

		if (response.success){
			this.estudiantes = response.data;
		} else {
			this.estudiantes = false;
		}

		this.loading = 0;
	},

	methods: {
		async deleteEstudiante(id){
			if (confirm("Desea eliminar este estudiante")){
				this.loading = 1;
				const response = await estudiantes.dispatch('delete', { id });

				if (response.success){
					const response = await estudiantes.dispatch('findAll');

					if (response.success){
						this.estudiantes = response.data;
					} else {
						this.estudiantes = false;
					}
				}

				this.loading = 0;
			}
		}
	}
}
</script>