import { shallowMount } from '@vue/test-utils';
import ValuationEstimator from '../../assets/components/ValuationEstimator.vue';

// Mock global fetch
global.fetch = jest.fn(() =>
    Promise.resolve({
        ok: true,
        json: () => Promise.resolve({ estimated_price: 25.5 }),
    })
);

describe('ValuationEstimator.vue', () => {
    beforeEach(() => {
        fetch.mockClear();
    });

    it('renders the form correctly', () => {
        const wrapper = shallowMount(ValuationEstimator);
        expect(wrapper.find('h2').text()).toMatch('Resale Value Estimator');
        expect(wrapper.find('button').text()).toBe('Get Estimate');
    });

    it('submits data and displays result', async () => {
        const wrapper = shallowMount(ValuationEstimator);

        // Fill form
        wrapper.find('#brand').setValue('Zara');
        wrapper.find('#condition').setValue('new');

        // Trigger submit
        await wrapper.find('form').trigger('submit.prevent');

        // Wait for async
        await wrapper.vm.$nextTick();
        await new Promise(resolve => setTimeout(resolve, 0)); // Flush promises

        // Verify fetch call
        expect(fetch).toHaveBeenCalledTimes(1);
        expect(fetch).toHaveBeenCalledWith('/api/v1/valuation/estimate', expect.objectContaining({
            method: 'POST',
            body: JSON.stringify({
                brand: 'Zara',
                condition: 'new',
                is_high_season: false
            })
        }));

        // Verify result display
        expect(wrapper.find('.result h3').text()).toContain('25.5€');
    });
});