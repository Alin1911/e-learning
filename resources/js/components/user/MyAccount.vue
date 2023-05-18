<template>
	<div class="container">
		<div class="row">
			<div class="col-4 my-3 px-0">
				<button
					class="btn w-100 btn-lg rounded-0 shadow border border-dark text-dark"
					:class="
						selectedTab === 1
							? 'btn-warning'
							: 'btn-outline-warning'
					"
					@click="
						selectedComponent = 'userAccount';
						selectedTab = 1;
					"
				>
					Contul meu
				</button>
			</div>
			<div class="col-4 my-3 px-0">
				<button
					class="btn w-100 btn-lg rounded-0 shadow border border-dark text-dark"
					:class="
						selectedTab === 2
							? 'btn-warning'
							: 'btn-outline-warning'
					"
					@click="
						selectedComponent = 'enrolledCourses';
						selectedTab = 2;
					"
				>
					Cursuri înrolate
				</button>
			</div>
			<div class="col-4 my-3 px-0">
				<button
					class="btn w-100 btn-lg rounded-0 shadow border border-dark text-dark"
					:class="
						selectedTab === 3
							? 'btn-warning'
							: 'btn-outline-warning'
					"
					@click="
						selectedComponent = 'userStats';
						selectedTab = 3;
					"
				>
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
			selectedTab: 1,
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
