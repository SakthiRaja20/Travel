/**
 * Hotel booking date utilities - Enhanced version
 */
const DateUtils = {
    /**
     * Format a date to YYYY-MM-DD
     * @param {Date} date - The date to format
     * @returns {string} - Formatted date string
     * @throws {Error} - If date is invalid
     */
    formatDate: (date) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    },

    /**
     * Get start of day for a date (midnight)
     * @param {Date} date - The date to normalize
     * @returns {Date} - Date at midnight
     * @throws {Error} - If date is invalid
     */
    getStartOfDay: (date) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }
        const d = new Date(date);
        d.setHours(0, 0, 0, 0);
        return d;
    },

    /**
     * Parse YYYY-MM-DD string to Date object
     * @param {string} dateStr - Date string in YYYY-MM-DD format
     * @returns {Date} - Parsed date object at midnight
     * @throws {Error} - If date string is invalid
     */
    parseDate: (dateStr) => {
        if (!dateStr || typeof dateStr !== 'string') {
            throw new Error('Invalid date string provided');
        }

        const trimmed = dateStr.trim();
        const parts = trimmed.split('-');
        
        if (parts.length !== 3) {
            throw new Error('Invalid date format, expected YYYY-MM-DD');
        }

        const [year, month, day] = parts.map(num => {
            const parsed = parseInt(num, 10);
            return parsed;
        });
        
        if (isNaN(year) || isNaN(month) || isNaN(day)) {
            throw new Error('Date contains invalid numbers');
        }

        // Validate ranges before creating date
        if (month < 1 || month > 12 || day < 1 || day > 31) {
            throw new Error('Invalid date value: month must be 1-12, day must be 1-31');
        }

        const date = new Date(year, month - 1, day);
        date.setHours(0, 0, 0, 0);

        // Validate the date components match (handles invalid dates like 2023-02-31)
        if (date.getFullYear() !== year || 
            date.getMonth() !== month - 1 || 
            date.getDate() !== day) {
            throw new Error('Invalid date value');
        }

        return date;
    },

    /**
     * Calculate number of nights between dates
     * @param {Date} startDate - Check-in date
     * @param {Date} endDate - Check-out date
     * @returns {number} - Number of nights (always non-negative)
     * @throws {Error} - If dates are invalid
     */
    calculateNights: (startDate, endDate) => {
        if (!(startDate instanceof Date) || !(endDate instanceof Date) || 
            isNaN(startDate) || isNaN(endDate)) {
            throw new Error('Invalid date objects');
        }

        const start = DateUtils.getStartOfDay(startDate);
        const end = DateUtils.getStartOfDay(endDate);
        const diffTime = end - start;
        const nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // Return 0 for same-day bookings, not negative values
        return Math.max(0, nights);
    },

    /**
     * Format date parts (day, month, weekday, year)
     * @param {Date} date - The date to format
     * @returns {Object} - Object with formatted date parts
     * @throws {Error} - If date is invalid
     */
    formatDateParts: (date) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }
        return {
            weekday: date.toLocaleDateString("en-GB", { weekday: 'short' }),
            day: date.toLocaleDateString("en-GB", { day: '2-digit' }),
            month: date.toLocaleDateString("en-GB", { month: 'short' }),
            year: date.toLocaleDateString("en-GB", { year: 'numeric' })
        };
    },

    /**
     * Check if date is in the past
     * @param {Date} date - The date to check
     * @returns {boolean} - True if date is before today
     * @throws {Error} - If date is invalid
     */
    isPastDate: (date) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }
        const today = DateUtils.getStartOfDay(new Date());
        return date < today;
    },

    /**
     * Check if checkout date is after checkin date
     * @param {Date} checkIn - Check-in date
     * @param {Date} checkOut - Check-out date
     * @returns {boolean} - True if checkout is after checkin
     * @throws {Error} - If dates are invalid
     */
    isValidDateRange: (checkIn, checkOut) => {
        if (!(checkIn instanceof Date) || !(checkOut instanceof Date) || 
            isNaN(checkIn) || isNaN(checkOut)) {
            throw new Error('Invalid date objects');
        }
        return checkOut > checkIn;
    },

    /**
     * Get date after N days
     * @param {Date} date - Starting date
     * @param {number} days - Number of days to add
     * @returns {Date} - New date at midnight
     * @throws {Error} - If date is invalid or days is not a number
     */
    addDays: (date, days) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }
        if (typeof days !== 'number' || isNaN(days)) {
            throw new Error('Days must be a valid number');
        }

        const result = new Date(date);
        result.setDate(result.getDate() + days);
        result.setHours(0, 0, 0, 0);
        return result;
    },

    /**
     * Get date N days before a given date
     * @param {Date} date - Starting date
     * @param {number} days - Number of days to subtract
     * @returns {Date} - New date at midnight
     * @throws {Error} - If date is invalid or days is not a number
     */
    subtractDays: (date, days) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }
        if (typeof days !== 'number' || isNaN(days)) {
            throw new Error('Days must be a valid number');
        }

        const result = new Date(date);
        result.setDate(result.getDate() - days);
        result.setHours(0, 0, 0, 0);
        return result;
    },

    /**
     * Get the last day of the month for a given date
     * @param {Date} date - Any date in the desired month
     * @returns {Date} - Last day of the month at midnight
     * @throws {Error} - If date is invalid
     */
    getLastDayOfMonth: (date) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }

        const year = date.getFullYear();
        const month = date.getMonth();
        const lastDay = new Date(year, month + 1, 0);
        lastDay.setHours(0, 0, 0, 0);
        return lastDay;
    },

    /**
     * Get the first day of the month for a given date
     * @param {Date} date - Any date in the desired month
     * @returns {Date} - First day of the month at midnight
     * @throws {Error} - If date is invalid
     */
    getFirstDayOfMonth: (date) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }

        const year = date.getFullYear();
        const month = date.getMonth();
        const firstDay = new Date(year, month, 1);
        firstDay.setHours(0, 0, 0, 0);
        return firstDay;
    },

    /**
     * Check if year is a leap year
     * @param {number} year - The year to check
     * @returns {boolean} - True if leap year
     * @throws {Error} - If year is not a valid number
     */
    isLeapYear: (year) => {
        if (typeof year !== 'number' || isNaN(year) || year < 1) {
            throw new Error('Year must be a positive number');
        }

        return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
    },

    /**
     * Format date for display (e.g., "Mon, 15 Jan 2025")
     * @param {Date} date - The date to format
     * @returns {string} - Formatted date string
     * @throws {Error} - If date is invalid
     */
    formatDisplayDate: (date) => {
        if (!(date instanceof Date) || isNaN(date)) {
            throw new Error('Invalid date object');
        }

        const parts = DateUtils.formatDateParts(date);
        return `${parts.weekday}, ${parts.day} ${parts.month} ${parts.year}`;
    },

    /**
     * Get date difference in various units
     * @param {Date} startDate - Start date
     * @param {Date} endDate - End date
     * @returns {Object} - Object with days, hours, minutes properties
     * @throws {Error} - If dates are invalid
     */
    getDateDifference: (startDate, endDate) => {
        if (!(startDate instanceof Date) || !(endDate instanceof Date) || 
            isNaN(startDate) || isNaN(endDate)) {
            throw new Error('Invalid date objects');
        }

        const start = DateUtils.getStartOfDay(startDate);
        const end = DateUtils.getStartOfDay(endDate);
        const diffTime = Math.abs(end - start);

        return {
            days: Math.floor(diffTime / (1000 * 60 * 60 * 24)),
            hours: Math.floor((diffTime / (1000 * 60 * 60)) % 24),
            minutes: Math.floor((diffTime / 1000 / 60) % 60)
        };
    }
};