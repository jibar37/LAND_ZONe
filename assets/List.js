class Coordinate {
	head = null;
	polygon = null;
	cord = [];
	constructor() {
		this.head = null;
		this.polygon = null;
	}
	input(Lat, Long) {
		let temp = null;
		let lat = Lat;
		let long = Long;
		let no = null;
		let baru = null;
		if (this.head == null) {
			no = 0;
			baru = new Node(lat, long, no);
			this.head = baru;
			this.cord = [[lat, long]];
			console.log('head');


		}
		else {
			temp = this.head;
			while (temp.next != null) {
				temp = temp.next;
			}
			no = temp.no + 1;
			baru = new Node(lat, long, no);
			this.cord.push([lat, long]);
			temp.next = baru;
			console.log('selanjutnya');
		}

	}
	remove(index) {
		this.cord.splice(index, 1);
		console.log("berhasil hapus");
	}
	addAfter(index, value) {
		this.cord.splice(index + 1, 0, value);
		console.log("berhasil addAfter");
		console.log(index);

	}

	show() {
		let temp = this.head;
		let lengkap;
		while (temp != null) {
			console.log('lat = ', temp.lat, ', long = ', temp.long, ', no = ', temp.no);
			lengkap = [temp.lat, temp.long]
			temp = temp.next;
		}
	}
	undo() {
		let temp;
		let temp1;
		if (this.head != null) {
			if (this.head.next == null) {
				this.head = null;
				this.cord = [];
			}
			else {
				temp = this.head;
				while (temp.next != null) {
					temp1 = temp;
					temp = temp.next;
				}
				this.cord.pop();
				temp1.next = null;
				console.log('masuk');
			}

		}
	}
}
class Node {
	lat = null;
	long = null;
	next = null;
	no = null;

	constructor(lat, long, no) {
		this.lat = lat;
		this.long = long;
		this.no = no;
	}
	setLat(lat) {
		this.lat = lat;
	}
	getLat() {
		return lat;
	}
	setLong(long) {
		this.long = long;
	}
	getLong() {
		return long;
	}
	setNo(no) {
		this.no = no;
	}
	getNo() {
		return no;
	}

	Print() {
		console.log('Berhasil buat objek baru');
	}
}
// function input(Lat, Long) {
// 	let temp = null;
// 	let lat = Lat;
// 	let long = Long;
// 	let no = null;
// 	let baru = null;
// 	if (head == null) {
// 		no = 0;
// 		baru = new Node(lat, long, no);
// 		head = baru;
// 	}
// 	else {
// 		temp = head;
// 		while (temp.next != null) {
// 			temp = temp.next;
// 		}
// 		no = temp.no + 1;
// 		baru = new Node(lat, long, no);
// 		temp.next = baru;
// 	}
// }

// function show() {
// 	let temp = head;
// 	let lengkap;
// 	while (temp != null) {
// 		console.log('lat = ', temp.lat, ', long = ', temp.long, ', no = ', temp.no);
// 		lengkap = [temp.lat, temp.long]
// 		temp = temp.next;
// 	}
// }
// function deleteNama(nama){
// 	let temp=null;
// 	if(nama==head.name){
// 		head=head.next;
// 		head.no = 0;
// 		temp = head.next;
// 		while(temp!=null){
// 			temp.no--;
// 			temp=temp.next;
// 		}	
// 	}
// 	else{
// 		temp = head;
// 		while(temp.next.name!=nama){
// 			temp = temp.next;
// 		}
// 		temp.next = temp.next.next;
// 		temp = temp.next;
// 		while(temp!=null){
// 			temp.no--;
// 			temp=temp.next;
// 		}	
// 	}
// }
// function inputAfter(nama){

// 	let temp=head;
// 	let add;
// 	while(temp.name!=nama[0]){
// 		temp=temp.next;
// 	}
// 	add = new Person(nama[1],temp.no+1);
// 	add.next = temp.next;
// 	temp.next = add;
// 	temp=add.next;
// 	while(temp!=null){
// 		temp.no=temp.no+1;
// 		temp=temp.next;
// 	}

// }



export { Node, Coordinate };