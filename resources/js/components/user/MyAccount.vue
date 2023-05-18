<template>
	<div class="container">
		<div class="row">
			<div class="col-12 my-3">
				<button class="btn btn-primary" @click="selectedComponent = 'userAccount'">
					Contul meu
				</button>
				<button class="btn btn-primary ms-2" @click="selectedComponent = 'enrolledCourses'">
					Cursuri înrolate
				</button>
				<button class="btn btn-primary ms-2" @click="selectedComponent = 'userStats'">
					Vezi statistici
				</button>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<component :is="selectedComponent"></component>
			</div>
		</div>
	</div>
</template>

<script>
import UserAccount from "./UserAccount.vue";
import EnrolledCourses from "./EnrolledCourses.vue";
import UserStats from "./UserStats.vue";

export default {
	name: "MyAccount",
	props: {
		user: {
			type: Object,
			required: true,
		},
	},
	data() {
		return {
			selectedComponent: "userAccount",
		};
	},
	components: {
		UserAccount,
		EnrolledCourses,
		UserStats,
	},
};
</script>
