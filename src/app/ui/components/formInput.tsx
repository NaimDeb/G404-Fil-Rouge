
export default function FormInput({
  name, label, type, defaultValue
}: { name: string, label: string, type: string, defaultValue?: string }) {
  return (
    <div className="mb-4">
    <label className="block text-primary-green text-sm font-bold mb-2" htmlFor={name}>{label}</label>
    <input className="shadow appearance-none rounded border-gray-300 border-[1px] w-full py-2 px-3 text-neutral-off-black leading-tight focus:outline-none focus:shadow-outline" name={name} id={name} type={type} defaultValue={defaultValue} />
</div>
  )
}
