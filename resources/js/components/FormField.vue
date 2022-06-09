<template>
    <DefaultField
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
    >
        <template #field>
            <div class="tw-w-full tw-grid tw-grid-cols-2">
                <div
                    v-for="(label, option) in field.options"
                    :key="option"
                    class="flex mb-2"
                >
                    <checkbox
                        :value="option"
                        :checked="isChecked(option)"
                        @input="toggleOption(option)"
                        class="tw-mr-2"
                    />
                    <label
                        :for="field.name"
                        v-text="label"
                        @click="toggleOption(option)"
                        class="tw-leading-tight"
                    ></label>
                </div>
            </div>
        </template>
    </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from "laravel-nova";

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ["resourceName", "resourceId", "field"],

    methods: {
        isChecked(option) {
            return this.value ? this.value.includes(option) : false;
        },

        toggleOption(option) {
            if (this.isChecked(option)) {
                this.value = this.value.filter((item) => item != option);
                return;
            }

            this.value.push(option);
        },

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || [];
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || []);
        },
    },
};
</script>
