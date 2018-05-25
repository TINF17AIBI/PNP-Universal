using System;
using System.Collections.Generic;

namespace PnP_Universal.Models
{
    public partial class ItemOwnership
    {
        public int Id { get; set; }
        public int OwnerId { get; set; }
        public int? ItemId { get; set; }
        public int Cnt { get; set; }

        public Items Id1 { get; set; }
        public Heroes IdNavigation { get; set; }
    }
}
