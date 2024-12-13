import { User } from '@/id-cards'
import { cn } from '@/lib/utils'
import * as React from 'react'

export type IDCard = {
    user: User
    ref: React.RefObject<HTMLDivElement>
}

export const CreateIDCard = React.forwardRef<HTMLDivElement, IDCard>(({ user }, ref) => {
        return (
            <div
                ref={ref}
                className="relative w-[40rem] h-auto aspect-[591/1004] text-center"
                style={{
                    backgroundImage: `url(${user.robot_category === 'sumo' ? '/id-card/template-sumo.png' : '/id-card/template-avoider.png'})`,
                    backgroundSize: 'cover',
                    backgroundPosition: 'center',
                }}
            >   
                <div className="absolute inset-0 flex flex-col justify-center items-center p-20 font-bold uppercase font-anton">
                    <h3 className="text-6xl mt-20 leading-normal text-slate-950 dark:text-slate-950">
                        {user.name}
                    </h3>
                </div>
                <div className="absolute bottom-40 right-16 text-right font-bold uppercase font-anton">
                    <h3 className={cn([
                        'text-5xl leading-normal max-w-md',
                        user.robot_category === 'sumo' ? 'text-slate-100 dark:text-slate-100' : 'text-slate-950 dark:text-slate-950' 
                    ])}>
                        {user.responsible_person_name}
                    </h3>
                </div>
            </div>
        )
    },
)

CreateIDCard.displayName = 'CreateIDCard'