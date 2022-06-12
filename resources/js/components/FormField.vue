<template>
    <DefaultField
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
    >
        <template #field>
            <div class="tw-w-full tw-columns-2" v-if="field.withGroups">
                <div
                    v-for="(groupOptions, group) in field.options"
                    :key="group"
                    class="tw-mb-4"
                >
                    <h3 class="tw-my-2 tw-text-lg tw-font-semibold">
                        {{ group }}
                    </h3>
                    <div
                        v-for="option in groupOptions"
                        :key="option.value"
                        class="tw-flex tw-mb-2"
                    >
                        <checkbox
                            :value="option.value"
                            :checked="isChecked(option.value)"
                            @input="toggleOption(option.value)"
                        />
                        <label
                            :for="field.name"
                            v-text="option.label"
                            @click="toggleOption(option.value)"
                            class="tw-w-full tw-ml-2"
                        ></label>
                    </div>
                </div>
            </div>
            <div class="tw-w-full tw-columns-2" v-else>
                <div
                    v-for="(label, value) in field.options"
                    :key="value"
                    class="tw-flex tw-mb-2"
                >
                    <checkbox
                        :value="value"
                        :checked="isChecked(value)"
                        @input="toggleOption(value)"
                        class="tw-mr-2"
                    />
                    <label
                        :for="field.name"
                        v-text="label"
                        @click="toggleOption(value)"
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
