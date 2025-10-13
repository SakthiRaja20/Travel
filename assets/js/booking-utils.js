/** @type {Object} */
const BookingUtils = {
    /**
     * Format currency amount
     * @param {number} amount - Amount to format
     * @returns {string} - Formatted currency string
     */
    formatCurrency: function(amount) {
        return Number(amount).toFixed(2);
    },

    /**
     * Calculate total price with discount
     * @param {number} basePrice - Price per night per room
     * @param {number} nights - Number of nights
     * @param {number} roomsNeeded - Number of rooms needed
     * @param {number} discount - Discount percentage (0-100)
     * @returns {number} - Total price after discount
     */
    calculatePrice: function(basePrice, nights, roomsNeeded, discount = 0) {
        const totalBeforeDiscount = basePrice * nights * roomsNeeded;
        const discountAmount = (totalBeforeDiscount * discount) / 100;
        return totalBeforeDiscount - discountAmount;
    },

    /**
     * Validate room capacity for group size
     * @param {number} roomCapacity - Capacity per room
     * @param {number} groupSize - Total guests
     * @returns {Object} - Validation result with roomsNeeded
     */
    validateCapacity: function(roomCapacity, groupSize) {
        return {
            isValid: roomCapacity >= groupSize,
            roomsNeeded: Math.ceil(groupSize / roomCapacity)
        };
    },

    /**
     * Parse date string in YYYY-MM-DD format to local Date object
     * This avoids timezone conversion issues by treating the string as local time
     * @param {string} dateStr - Date string in YYYY-MM-DD format
     * @returns {Date} - Date object at local midnight
     * @throws {Error} - If date string is invalid
     */
    parseLocalDate: function(dateStr) {
        if (!dateStr || typeof dateStr !== 'string') {
            throw new Error('Invalid date string');
        }

        const parts = dateStr.trim().split('-');
        if (parts.length !== 3) {
            throw new Error('Date must be in YYYY-MM-DD format');
        }

        const [year, month, day] = parts.map(p => parseInt(p, 10));

        if (isNaN(year) || isNaN(month) || isNaN(day)) {
            throw new Error('Date contains invalid numbers');
        }

        if (month < 1 || month > 12 || day < 1 || day > 31) {
            throw new Error('Invalid date: month must be 1-12, day must be 1-31');
        }

        // Create date in LOCAL timezone using string parsing approach
        // This ensures YYYY-MM-DD is interpreted as local midnight, not UTC
        const dateObj = new Date(dateStr + 'T00:00:00');

        // Validate the date components match (handles invalid dates like 2023-02-31)
        if (dateObj.getFullYear() !== year || 
            dateObj.getMonth() !== month - 1 || 
            dateObj.getDate() !== day) {
            throw new Error('Invalid date value');
        }

        return dateObj;
    },

    /**
     * Get today's date at local midnight
     * @returns {Date} - Today's date at local midnight
     */
    getTodayAtMidnight: function() {
        const now = new Date();
        return new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0, 0);
    },

    /**
     * Compare two local dates (ignoring time component)
     * @param {Date} date1 - First date
     * @param {Date} date2 - Second date
     * @returns {number} - -1 if date1 < date2, 0 if equal, 1 if date1 > date2
     */
    compareDates: function(date1, date2) {
        const d1 = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
        const d2 = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate());

        if (d1 < d2) return -1;
        if (d1 > d2) return 1;
        return 0;
    },

    /**
     * Calculate days between two dates (date2 - date1)
     * @param {Date} date1 - Start date
     * @param {Date} date2 - End date
     * @returns {number} - Number of days
     */
    daysBetween: function(date1, date2) {
        const msPerDay = 1000 * 60 * 60 * 24;
        const d1 = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
        const d2 = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate());
        
        return Math.floor((d2 - d1) / msPerDay);
    },

    /**
     * Validate booking dates
     * @param {string|Date} checkIn - Check-in date (YYYY-MM-DD or Date object)
     * @param {string|Date} checkOut - Check-out date (YYYY-MM-DD or Date object)
     * @returns {Object} - Validation result
     */
    validateDates: function(checkIn, checkOut) {
        if (!checkIn || !checkOut) {
            return { 
                isValid: false, 
                message: 'Check-in and check-out dates are required',
                daysUntilCheckIn: 0,
                stayDuration: 0
            };
        }

        try {
            // Parse dates - handle both string and Date inputs
            let checkInDate, checkOutDate;
            
            if (typeof checkIn === 'string') {
                checkInDate = this.parseLocalDate(checkIn);
            } else if (checkIn instanceof Date) {
                checkInDate = new Date(checkIn.getFullYear(), checkIn.getMonth(), checkIn.getDate());
            } else {
                throw new Error('Check-in must be a string (YYYY-MM-DD) or Date object');
            }

            if (typeof checkOut === 'string') {
                checkOutDate = this.parseLocalDate(checkOut);
            } else if (checkOut instanceof Date) {
                checkOutDate = new Date(checkOut.getFullYear(), checkOut.getMonth(), checkOut.getDate());
            } else {
                throw new Error('Check-out must be a string (YYYY-MM-DD) or Date object');
            }

            const today = this.getTodayAtMidnight();

            // Use local midnight for comparison to respect timezone
            const todayLocal = new Date(today.getFullYear(), today.getMonth(), today.getDate()).getTime();
            const checkInLocal = new Date(checkInDate.getFullYear(), checkInDate.getMonth(), checkInDate.getDate()).getTime();
            const checkOutLocal = new Date(checkOutDate.getFullYear(), checkOutDate.getMonth(), checkOutDate.getDate()).getTime();

            console.log('Date comparison (local):', {
                today: new Date(todayLocal).toISOString().split('T')[0],
                checkIn: new Date(checkInLocal).toISOString().split('T')[0],
                checkOut: new Date(checkOutLocal).toISOString().split('T')[0]
            });

            // Calculate days using local timestamps
            const MS_PER_DAY = 24 * 60 * 60 * 1000;
            const daysUntilCheckIn = Math.floor((checkInLocal - todayLocal) / MS_PER_DAY);
            const stayDuration = Math.floor((checkOutLocal - checkInLocal) / MS_PER_DAY);

            console.log('Date calculations:', {
                daysUntilCheckIn,
                stayDuration,
                today: today.toLocaleDateString(),
                checkIn: checkInDate.toLocaleDateString(),
                todayTime: today.getTime(),
                checkInTime: checkInDate.getTime(),
                timeDiff: checkInDate.getTime() - today.getTime()
            });

            // Check if checkin is today or in the future
            if (daysUntilCheckIn < 0) {
                return {
                    isValid: false,
                    message: 'Check-in date must be today or in the future',
                    daysUntilCheckIn,
                    stayDuration
                };
            }

            // Ensure checkout is after checkin
            if (stayDuration < 1) {
                return {
                    isValid: false,
                    message: 'Check-out date must be after check-in date',
                    daysUntilCheckIn,
                    stayDuration
                };
            }

            return {
                isValid: true,
                message: '',
                daysUntilCheckIn,
                stayDuration,
                checkIn: checkInDate,
                checkOut: checkOutDate
            };

        } catch (error) {
            console.error('Date validation error:', error);
            return {
                isValid: false,
                message: error.message || 'Invalid date format',
                daysUntilCheckIn: 0,
                stayDuration: 0
            };
        }
    },

    /**
     * Show error message
     * @param {string} message - Error message to display
     */
    /**
     * Get today's date at UTC midnight
     * @returns {Date} - Today's date at UTC midnight
     */
    getTodayAtMidnight: function() {
        const now = new Date();
        return new Date(Date.UTC(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate()));
    },

    showError: function(message) {
        alert(message);
    },

    /**
     * Create HTML element with attributes
     * @param {string} tag - HTML tag name
     * @param {Object} attributes - Element attributes
     * @param {string|HTMLElement} content - Element content
     * @returns {HTMLElement} - Created element
     */
    createElement: function(tag, attributes = {}, content = '') {
        const element = document.createElement(tag);
        Object.entries(attributes).forEach(([key, value]) => {
            element.setAttribute(key, value);
        });
        
        if (content instanceof HTMLElement) {
            element.appendChild(content);
        } else if (content) {
            element.textContent = content;
        }
        
        return element;
    }
};

// Make it globally available
window.BookingUtils = BookingUtils;