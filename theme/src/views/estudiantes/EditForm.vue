<template>
	<main>
		<div class="p-4">
			<form-estudiantes :idEstudiante="id"></form-estudiantes>
		</div>
	</main>
</template>

<script>
import FormEstudiantes from '../../components/estudiantes/EditEstudiantes.vue'
import { ref } from 'vue';

export default {
	components: {
		FormEstudiantes
	},

	props: {
        id: {
            type: String,
            default: '0'
        },
    },

	setup() {
		const name = ref('Joe')

		return {
			name
		}
	}
}
</script>