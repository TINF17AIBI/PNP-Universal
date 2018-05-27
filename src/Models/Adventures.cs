using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class Adventures
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public int Gamemaster { get; set; }
        public int Template { get; set; }
        public string InviteCode { get; set; }
        public string Description { get; set; }
        public Users Id1 { get; set; }
        public Templates IdNavigation { get; set; }
        public Heroes Heroes { get; set; }
        public Items Items { get; set; }
    }
}
