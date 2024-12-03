import * as React from 'react'

function Countdown() {
    const targetDate = new Date('December 10, 2024').getTime()
    const [timeLeft, setTimeLeft] = React.useState({
        days: 0,
        hours: 0,
        minutes: 0,
        seconds: 0
    })

    React.useEffect(() => {
        const timer = setInterval(() => {
            const now = new Date().getTime()
            const difference = targetDate - now

            if (difference > 0) {
                const days = Math.floor(difference / (1000 * 60 * 60 * 24))
                const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
                const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60))
                const seconds = Math.floor((difference % (1000 * 60)) / 1000)

                setTimeLeft({ days, hours, minutes, seconds })
            }
        }, 1000)

        return () => clearInterval(timer)
    }, [])

    return (
        <>
            <h3 className="text-slate-600 dark:text-slate-400">{timeLeft.days} Hari, {timeLeft.hours} Jam, {timeLeft.minutes} Menit, {timeLeft.seconds} Detik</h3>
        </>
    )
}

export default Countdown