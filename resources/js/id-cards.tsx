import axios from 'axios';
import { toPng } from 'html-to-image';
import * as React from 'react';
import ReactDOM from 'react-dom/client';
import { CreateIDCard, IDCard } from './components/IDCardP';
import { Button } from './components/ui/button';

export type Payment = {
    id: number;
    user_id: number;
    receipt_image: string;
    payment_method: string;
    status: string;
    created_at: string;
    updated_at: string;
}

export type User = {
    id: number;
    name: string;
    role: string;
    email: string;
    agency: string;
    robot_category: string;
    whatsapp_number: string;
    responsible_person_name: string;
    responsible_person_nim_or_nis: string | null;
    participant_one_name: string;
    participant_one_nim_or_nis: string | null;
    participant_two_name: string;
    participant_two_nim_or_nis: string | null;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    payment: Payment;

    profile?: string | null
}

const IdCards: React.FC = () => {
    const [users, setUsers] = React.useState<User[]>([]);
    const [IDCards, setIDCards] = React.useState<IDCard[]>([])
    const [name, setName] = React.useState<string>('')

    const downloadIDCard = async ({ user, ref }: IDCard) => {
        if (ref.current === null) return

        try {
            const imgData = await toPng(ref.current, {
                quality: 0.8,
                pixelRatio: 1,
            })

            const link = document.createElement('a')
            link.href = imgData
            link.download = `${user.name} ID Card.png`
            link.click()

            // const pdf = new jsPDF('portrait', 'px', [591, 1004])
            // pdf.addImage(imgData, 'PNG', 0, 0, 591, 1004)
            // pdf.save(`${division.name} ${user.name} ID Card.pdf`)
        } catch (error) {
            console.error('Could not generate ID Card image', error)
        }
    }

    const downloadAllIDCard = () => {
        const userAgent = window.navigator.userAgent
        
        if( userAgent === 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36' ) {
            IDCards.forEach(async IDCard => {
                await downloadIDCard({ ...IDCard })
            })
        }
    }

    React.useEffect(() => {
        const fetchUsers = async () => {
            try {
                const response = await axios.get('/api/teams');
                setUsers(response.data);
            } catch (error) {
                console.error('Error fetching users:', error);
            }
        };

        fetchUsers();
    }, []);

    React.useEffect(() => {
        // search by name
        const search = name
            ? users.filter(user =>
                  user.name.toLowerCase().includes(name.toLowerCase()),
              )
            : users

        const newStates = search.map(user => {
            return {
                user,
                ref: React.createRef<HTMLDivElement>(),
            } as IDCard
        })

        setIDCards(newStates)
    }, [name, users])

    return (
        <>
            <div className='mb-8'>
                <h3 className='mb-4'>ID Card Peserta</h3>
                <Button onClick={downloadAllIDCard}>
                    Download
                </Button>
            </div>
            <div className="grid grid-cols-1 lg:grid-cols-3 bg-slate-200 rounded-xl">
                {IDCards.map(IDCard => {
                    return (
                        <div
                            key={IDCard.user.id}
                            className="flex justify-center items-center h-[700px]"
                        >
                            <div className="scale-50">
                                <CreateIDCard {...IDCard} />
                            </div>
                        </div>
                    )
                })}
            </div>
        </>
    );
}

ReactDOM.createRoot(document.getElementById('id-cards') as HTMLElement).render(<IdCards />)