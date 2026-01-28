<template>
    <div class="valuation-estimator">
        <h2>Resale Value Estimator</h2>

        <form @submit.prevent="estimatePrice">
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" v-model="form.brand" id="brand" placeholder="Zara">
            </div>

            <div class="form-group">
                <label for="condition">Condition</label>
                <select v-model="form.condition" id="condition" required>
                    <option value="new">New with tags</option>
                    <option value="good">Good condition</option>
                    <option value="fair">Fair / Used</option>
                </select>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" v-model="form.is_high_season" id="is_high_season">
                <label for="is_high_season">Is High Season?</label>
            </div>

            <button type="submit" :disabled="loading">
                {{ loading ? 'Calculating...' : 'Get Estimate' }}
            </button>
        </form>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <div v-if="result !== null" class="result">
            <h3>Estimated Price: {{ result }}€</h3>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            form: {
                brand: '',
                condition: 'good',
                is_high_season: false,
            },
            loading: false,
            error: null,
            result: null,
        };
    },
    methods: {
        async estimatePrice () {
            this.loading = true;
            this.error = null;
            this.result = null;

            try {
                const response = await fetch('/api/v1/valuation/estimate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(this.form),
                });

                if (!response.ok) {
                    throw new Error('Failed to get estimate. Please try again.');
                }

                const data = await response.json();
                this.result = data.estimated_price;
            } catch (err) {
                this.error = err.message;
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>

<style scoped>
.valuation-estimator {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
}
.form-group {
    margin-bottom: 15px;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.checkbox-group input {
    width: auto;
}

.checkbox-group label {
    margin-bottom: 0;
}
label {
    display: block;
    margin-bottom: 5px;
}
input, select {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}
button {
    width: 100%;
    padding: 10px;
    background-color: #4f805d;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
button:disabled {
    background-color: #ccc;
}
.error {
    color: red;
    margin-top: 10px;
}
.result {
    margin-top: 20px;
    padding: 10px;
    background-color: #e9f5ed;
    border-radius: 4px;
    text-align: center;
}
</style>
