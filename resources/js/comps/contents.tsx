import { MapPin } from 'lucide-react'
import * as React from 'react'

export const Timeline: React.FC = () => {
    return (
        <>
            <div className="-my-6">
                {/* Item #1 */}
                <div className="relative pl-8 sm:pl-32 py-6 group">
                    <div className="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden before:absolute before:left-2 sm:before:left-0 before:h-full before:px-px before:bg-slate-300 sm:before:ml-[6.5rem] before:self-start before:-translate-x-1/2 before:translate-y-3 after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 after:bg-slate-600 after:border-4 after:box-content after:border-slate-50 after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
                        <time className="sm:absolute left-0 translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-slate-600 bg-slate-100 rounded-full">
                            13 Dec 2024
                        </time>
                        <div className="text-md font-bold text-slate-900 dark:text-white">
                            Registration Close
                        </div>
                    </div>
                    <div className="text-slate-500 dark:text-slate-100/50">
                        Pendaftaran untuk kompetisi akan ditutup pada tanggal 13 Desember 2024.
                    </div>
                </div>
                <div className="relative pl-8 sm:pl-32 py-6 group">
                    <div className="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden before:absolute before:left-2 sm:before:left-0 before:h-full before:px-px before:bg-slate-300 sm:before:ml-[6.5rem] before:self-start before:-translate-x-1/2 before:translate-y-3 after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 after:bg-slate-600 after:border-4 after:box-content after:border-slate-50 after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
                        <time className="sm:absolute left-0 translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-slate-600 bg-slate-100 rounded-full">
                            15 Des 2024
                        </time>
                        <div className="text-md font-bold text-slate-900 dark:text-white">
                            {`Technical Meeting (Online)`}
                        </div>
                    </div>
                    <div className="text-slate-500 dark:text-slate-100/50">
                        Technical Meeting akan dilaksanakan pada tanggal 15 Desember 2024.
                    </div>
                </div>
                <div className="relative pl-8 sm:pl-32 py-6 group">
                    <div className="flex flex-col sm:flex-row items-start mb-1 group-last:before:hidden before:absolute before:left-2 sm:before:left-0 before:h-full before:px-px before:bg-slate-300 sm:before:ml-[6.5rem] before:self-start before:-translate-x-1/2 before:translate-y-3 after:absolute after:left-2 sm:after:left-0 after:w-2 after:h-2 after:bg-slate-600 after:border-4 after:box-content after:border-slate-50 after:rounded-full sm:after:ml-[6.5rem] after:-translate-x-1/2 after:translate-y-1.5">
                        <time className="sm:absolute left-0 translate-y-0.5 inline-flex items-center justify-center text-xs font-semibold uppercase w-20 h-6 mb-3 sm:mb-0 text-slate-600 bg-slate-100 rounded-full">
                            27 Des 2024
                        </time>
                        <div className="text-md font-bold text-slate-900 dark:text-white">
                            {`IIT Challenge at Universitas Hamzanwadi (UNHAZ)`}
                        </div>
                    </div>
                    <div className="text-slate-500 dark:text-slate-100/50">
                        Lomba IIT Challenge akan dilaksanakan pada tanggal 27 - 28 Desember 2024 di Universitas Hamzanwadi.
                    </div>
                </div>
            </div>
            {/* End: Vertical Timeline #1 */}

            <div className="mt-10 flex items-center text-sm">
                <MapPin className="h-[1.2rem] w-[1.2rem] mr-2 text-slate-950/50 dark:text-slate-100/50" />
                Kampus 1, Universitas Hamzanwadi
            </div>
        </>
    )
}

export const SumoRobotSpesification: React.FC = () => {
    return (
        <>
            <ul className="list-disc space-y-3 text-slate-950/70 dark:text-slate-100/70">
                <li className="ml-10">{`The robot used is an RC robot. The robot is not allowed to use autonomous or semi-autonomous systems.`}</li>
                <li className="ml-10">{`The robot used in the competition has maximum dimensions of 20 cm x 20 cm with unlimited height (dimensions are measured at the robot's starting position). The total robot mass including batteries is maximum 1 kg (remote not included).`}</li>
                <li className="ml-10">{`The voltage source must come from a Dry Accu battery (lead acid), NiCd, NiMH, Li-ion, or Li-Polymer battery.`}</li>
                <li className="ml-10">{`The robot must be labelled with the name of each team on the front of the robot. The font type and size are free, but must be clearly visible to the referee.`}</li>
                <li className="ml-10">{`The robot must not have devices that damage the competition arena and flip opponents by throwing.`}</li>
                <li className="ml-10">{`The robot is not allowed to have devices that interfere with the performance of opponents' robots such as signal jammers, strobe lights, lasers, and the like.`}</li>
                <li className="ml-10">{`The robot must not have systems to attach itself to the surface of the competition arena such as suction cups, diaphragms, sticky wheels, or similar devices.`}</li>
                <li className="ml-10">{`The robot must not use weapons such as projectiles or saws and must not use easily flammable devices as weapons.`}</li>
                <li className="ml-10">{`During the competition, the robot must not intentionally break into several parts (break into several robots or separate robot parts).`}</li>
                <li className="ml-10">{`The robot is not allowed to have devices that can increase downforce, such as vacuum pumps and magnets.`}</li>
            </ul>
        </>
    )
}

export const SumoArena: React.FC = () => {
    return (
        <>
            {/* <ul className="list-disc space-y-3 text-slate-950/70 dark:text-slate-100/70">
                <li className="ml-10"><strong>Material:</strong> The sumo robot competition arena is made of Medium Density Fibreboard (MDF) and covered with a black rubber sheet with a thickness of 5 mm.</li>
                <li className="ml-10"><strong>Dimensions:</strong> The competition arena is circular with a diameter of 77 cm and a height of 2.5 cm.</li>
                <li className="ml-10"><strong>Markings:</strong> The competition arena is marked with white lines as the boundary lines on the edge of the arena, with a width of 2.5 cm. The starting line for each robot is in the center of the arena, dark red in color, with dimensions of 10 cm x 1 cm and a distance of 10 cm between them.</li>
            </ul> */}
            <div className="flex justify-center mt-10">
                <img src="/arena.jpg" alt="Arena" width={600} height={600} loading='lazy' className="rounded-xl" />
            </div>
        </>
    )
}

export const SumoCompetitionRules: React.FC = () => {
    return (
        <>
            <div className="mb-10">
                <div className="mb-4 font-semibold">
                    A. During the Competition
                </div>
                <ul className="list-disc space-y-3 text-slate-950/70 dark:text-slate-100/70">
                    <li className="ml-10"><strong>Material:</strong> The sumo robot competition arena is made of Medium Density Fibreboard (MDF) and covered with a black rubber sheet with a thickness of 5 mm.</li>
                    <li className="ml-10">Participants are expected to understand the calling sequence for the conduct of the competition based on the rundown provided by the organizers.</li>
                    <li className="ml-10">During the START, no external assistance to the robot is allowed, either in the form of pushing or otherwise.</li>
                    <li className="ml-10">Participants and teams are PROHIBITED from changing power sources and other components during the competition.</li>
                    <li className="ml-10">Robots must not break into several robots during the competition.</li>
                    <li className="ml-10">Any damage to the robot is the responsibility of the participant.</li>
                    <li className="ml-10">All decisions made by the organizers, referees, and judges are final and cannot be contested.</li>
                </ul>
            </div>
            <div>
                <div className="mb-4 font-semibold">
                    B. After the Competition:
                </div>
                <ul className="list-disc space-y-3 text-slate-950/70 dark:text-slate-100/70">
                    <li className="ml-10">Participants and teams must maintain the spirit, health, and sportsmanship of the competition.</li>
                    <li className="ml-10">Any decision made by the organizers is final and cannot be contested.</li>
                </ul>
            </div>
        </>
    )
}

export const SumoAssessment: React.FC = () => {
    return (
        <>
            <ul className="list-disc space-y-3 text-slate-950/70 dark:text-slate-100/70">
                <li className="ml-10">A robot that successfully pushes the opponent out of the arena or causes the opponent to touch the floor last will be awarded one point.</li>
                <li className="ml-10">If no robot exits the arena, then neither team receives points.</li>
                <li className="ml-10">If a robot does not collide with the opponent within 15 seconds, the opposing team receives one point.</li>
                <li className="ml-10"><strong>Survive time:</strong> The time spent in the arena before being defeated or overthrown.</li>
                <li className="ml-10"><strong>Win time:</strong> The time taken to score.</li>
            </ul>
        </>
    )
}

export const SumoViolationsAndPenalties: React.FC = () => {
    return (
        <ul className="list-disc space-y-3 text-slate-950/70 dark:text-slate-100/70">
            <li className="ml-10">Participants will be <strong>DISQUALIFIED</strong> for violating the rules established by the organizers.</li>
            <li className="ml-10">Participants will be <strong>DISQUALIFIED</strong> for creating disturbances during the competition.</li>
            <li className="ml-10">Participants will be <strong>DISQUALIFIED</strong> if they fail to meet the competition requirements.</li>
            <li className="ml-10">During the competition, if a participant does not appear by the third call, their match will be moved to the last order (this policy applies only once per round). If the participant still does not appear in the next opportunity, they will be <strong>DISQUALIFIED</strong>.</li>
        </ul>
    )
}