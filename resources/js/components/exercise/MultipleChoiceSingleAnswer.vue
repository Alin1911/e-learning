<template>
	<div>
		<div
			v-for="(option, index) in options"
			:key="index"
			class="form-check px-4 py-2"
		>
			<input
				type="radio"
				class="mt-2 form-check-input"
				name="single-answer"
				:id="`option-${index}`"
				v-model="correctIndex"
				:value="index"
			/>
			<label class="form-check-label" :for="`option-${index}`">
				<input
					type="text"
					class="form-control"
					v-model="option.answer"
					placeholder="Răspuns"
				/>
			</label>
		</div>
		<button @click="addOption" class="btn btn-secondary mt-2">
			Adaugă opțiune
		</button>
	</div>
</template>

<script>
export default {
	props: {
		modelValue: {
			type: Object,
			default: () => ({}),
		},
	},
	emits: ["input"],
	data() {
		return {
			options: [{ answer: "" }],
			correctIndex: 0,
		};
	},
	methods: {
		addOption() {
			this.options.push({ answer: "" });
		},
	},
	watch: {
		options: {
			handler(value) {
				this.$emit("input", {
					options: value,
					correctIndex: this.correctIndex,
				});
			},
			deep: true,
		},
		correctIndex(value) {
			this.$emit("input", { options: this.options, correctIndex: value });
		},
	},
};
</script>
